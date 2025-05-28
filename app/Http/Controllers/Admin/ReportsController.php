<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrdersProduct;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isNull;
use Carbon\Carbon;
use App\Helpers\SalesHelper;

class ReportsController extends Controller
{
    public function salesReports(Request $request) {
    Session::put('page', 'income_statement');
    $vendor_id = auth()->guard('admin')->user()->vendor_id;
    $auth_type = auth()->guard('admin')->user()->type;

    // Call SalesHelper ONCE
    $salesHelper = new SalesHelper();
    $weeklyRanges = collect($salesHelper->getFridayToThursdayRanges());
    $sixWeekChunks = $weeklyRanges->chunk(6);

    // Prepare releases from orders grouped in 6-week chunks
    $releases = [];
    $vendor = \App\Models\Vendor::with('vendor_bank')->find($vendor_id);

    foreach ($sixWeekChunks as $chunk) {
        $chunkFrom = $chunk->first()['from'];
        $chunkTo = $chunk->last()['to'];
        $chunkLabel = $chunk->first()['label'] . ' to ' . $chunk->last()['label'];

        // Only get orders for this vendor and in current 6-week chunk
        $orders = OrdersProduct::where('vendor_id', $vendor_id)
            ->whereBetween('created_at', [$chunkFrom, $chunkTo])
            ->whereNotIn('item_status', ['Pending Refund', 'Refunded', 'Refund Approved'])
            ->get();

        if ($orders->isNotEmpty()) {
            $totalAmount = $orders->sum(fn($o) => $o->product_price * $o->product_qty);
            $orderIds = implode(',', $orders->pluck('order_id')->unique()->toArray());

            $releases[] = [
                'vendor' => $vendor->toArray(),
                'Date Range' => $chunkLabel,
                'amount' => $totalAmount,
                'order_ids' => $orderIds
            ];
        }
    }

    $total_income = OrdersProduct::totalIncome($vendor_id);
    $latest_payout = OrdersProduct::latestPayout($vendor_id);
    // Breakdown per product
    $productBreakdown = OrdersProduct::selectRaw('product_name, created_at, item_status, SUM(product_qty) as total_qty, SUM(product_price * product_qty) as total_revenue')
        ->where('vendor_id', $vendor_id)
        ->whereNotIn('item_status', ['Pending Refund', 'Refunded', 'Refund Approved'])
        ->groupBy('product_name', 'created_at','item_status')
        ->get();

    $revenue = OrdersProduct::where('vendor_id', $vendor_id)
        ->whereNotIn('item_status', ['Pending Refund', 'Refunded', 'Refund Approved'])
        ->selectRaw('SUM(product_price * product_qty) as total_sales')
        ->value('total_sales');

    $buyers = OrdersProduct::where('vendor_id', $vendor_id)
        ->selectRaw('COUNT(DISTINCT user_id) as total_buyers')
        ->value('total_buyers');

    $top_items = OrdersProduct::where('vendor_id', $vendor_id)
        ->selectRaw('product_id, COUNT(product_id) as count')
        ->groupBy('product_id')
        ->orderByDesc('count')
        ->get();

    $order_count = OrdersProduct::where('vendor_id', $vendor_id)->count();

    // Group release items
    $release_items_by_date = collect($releases)->mapWithKeys(function ($release) {
        $order_ids = explode(',', $release['order_ids']);

        $items = OrdersProduct::whereIn('order_id', $order_ids)
            ->whereNotIn('item_status', ['Pending Refund', 'Refunded', 'Refund Approved'])
            ->select('product_name', 'product_qty', 'product_price', 'item_status')
            ->get()
            ->groupBy('product_name')
            ->map(function ($itemsGroup) {
                return [
                    'total_qty' => $itemsGroup->sum('product_qty'),
                    'total_revenue' => $itemsGroup->sum(fn($item) => $item->product_price * $item->product_qty),
                    'items' => $itemsGroup->map(fn($item) => [
                        'product_qty' => $item->product_qty,
                        'product_price' => $item->product_price,
                        'item_status' => $item->item_status,
                    ])
                ];
            });

        $release_total_revenue = $items->sum('total_revenue');

        return [
            $release['Date Range'] => [
                'items' => $items,
                'total_revenue' => $release_total_revenue,
            ]
        ];
    });

    // Recalculate release amount
    $releases = collect($releases)->map(function ($release) use ($release_items_by_date) {
        $release['amount'] = $release_items_by_date[$release['Date Range']]['total_revenue'] ?? 0;
        return $release['amount'] > 0 ? $release : null;
    })->filter();

    // Map releases for transaction tracking
    $releases = $releases->map(function ($value) {
        $vendor_bank = $value['vendor']['vendor_bank'] ?? null;

        $vendor_bank_id = $vendor_bank['id'] ?? null;
        $vendor_bank_name = $vendor_bank['bank_name'] ?? null;
        $vendor_bank_accnum = $vendor_bank['account_number'] ?? null;
        $condition = [
            'vendor_bank_details_id' => $vendor_bank_id,
            'date_range' => $value['Date Range'],
        ];

        $transaction = \App\Models\VendorSalesTransaction::where($condition)
            ->whereNotIn('status', ['pending refund', 'refunded', 'refund approved'])
            ->first();

        return [
            'id' => $transaction->id ?? false,
            'Date Range' => $value['Date Range'],
            'amount' => $value['amount'],
            'shop_name' => \App\Models\VendorsBusinessDetail::where('vendor_id', $value['vendor']['id'])->value('shop_name'),
            'bank_name' => $vendor_bank_name,
            'transaction_number' => $transaction->transaction_number ?? null,
            'status' => $transaction->status ?? false,
            'account_number' => $vendor_bank_accnum,
        ];
    })->toArray();

    $date_dropdown_filter = collect($releases)->pluck('Date Range');
    $nextThursday = Carbon::now()->next(Carbon::THURSDAY)->format('M d Y');

    $digit4_accnum = null;
    if ($auth_type == 'vendor' && !empty($vendor->vendorBank)) {
        $accnum = $vendor->vendorBank->account_number;
        $digit4_accnum = substr($accnum, -4);
    }
        return view('admin.reports.sales')->with(compact('revenue', 'order_count', 'buyers','releases','total_income','latest_payout','auth_type', 'date_dropdown_filter', 'nextThursday', 'digit4_accnum','productBreakdown','release_items_by_date'))->with('top_items', $top_items);
    }

    public function salesReportsUpdateStatus (Request $request) {
        $status = $request->input('status');
        $releasetransaction_id = $request->input('releasetransaction_id');

        try {
            $statusUpdate = \App\Models\VendorSalesTransaction::where(['id' => $releasetransaction_id])
                ->update(['status' => $status]);
    
            if ($statusUpdate) {
                return response()->json([
                    'success' => true,
                    'status' => $status,
                    'message' => "Successfully updated status of {$releasetransaction_id}"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}