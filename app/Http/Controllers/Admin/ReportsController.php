<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrdersProduct;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isNull;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function salesReports(Request $request) {
        Session::put('page', 'income_statement');
        $vendor_ordersProduct = OrdersProduct::where('vendor_id', auth()->guard('admin')->user()->vendor_id);
        $get_Buyers = $vendor_ordersProduct;
        $get_topItems = $vendor_ordersProduct;
        $get_OrdersCnt = $vendor_ordersProduct;

        $releases = OrdersProduct::releaseHistory(auth()->guard('admin')->user()->vendor_id);
        //dd($releases);
        $today = Carbon::now();
        $dateRanges = collect();

        
        $startDate = Carbon::parse('2020-01-01');
        $endDate = $today;

        while ($startDate->lte($endDate)) {
            $startOfWeek = $startDate->copy()->startOfWeek();
            $endOfWeek = $startOfWeek->copy()->endOfWeek();

            $dateRanges->push([
                'start_date' => $startOfWeek->toDateString(),
                'end_date' => $endOfWeek->toDateString()
            ]);

            $startDate = $endOfWeek->addDay();
        }

        $releases = $releases->filter(function ($release) use ($dateRanges) {

            $releaseDate = Carbon::parse($release->created_at);

            foreach ($dateRanges as $range) {
                $start_date = Carbon::parse($range['start_date']);
                $end_date = Carbon::parse($range['end_date']);

                if ($releaseDate->between($start_date, $end_date)) {
                    return true;
                }
            }

            return false; // Return false if no match found
        });


        $total_income = OrdersProduct::totalIncome(auth()->guard('admin')->user()->vendor_id);
        
        $latest_payout = OrdersProduct::latestPayout(auth()->guard('admin')->user()->vendor_id);
        
        $productBreakdown = OrdersProduct::selectRaw('product_name, created_at, item_status, SUM(product_qty) as total_qty, SUM(product_price * product_qty) as total_revenue')
            ->where('vendor_id', auth()->guard('admin')->user()->vendor_id)
            ->whereNotIn('item_status', ['Pending Refund', 'Refunded', 'Refund Approved'])
            ->groupBy('product_name', 'created_at','item_status')
            ->get();
        
        $revenue = $vendor_ordersProduct
            ->whereNotIn('item_status', ['Pending Refund', 'Refunded', 'Refund Approved'])
            ->selectRaw('SUM(product_price * product_qty) as total_sales')
            // ->value('total_sales')
            ->toRawSql();
        dd($revenue);
        

        $buyers = $get_Buyers->selectRaw('COUNT(user_id) as count')
            ->groupBy('user_id')
            ->count();

        $top_items = $get_topItems->selectRaw('COUNT(product_id) as count')
            ->groupBy('product_id')
            ->orderBy('count')
            ->get();

        $order_count = $get_OrdersCnt->get()->count();

        $auth_type = auth()->guard('admin')->user()->type;

        if ($request->isMethod('post')) {
            $transaction_nums = $request->input('transaction_num');
            $data_releases = $request->input('release');
            $c_transaction_nums = collect($transaction_nums)->filter(function ($value, $key) {
                return !is_null($value);
            })->toArray();

            foreach ($releases as $key => $release) {
                if (in_array($release['Date Range'], array_keys($c_transaction_nums))) {
                    $new_data = [
                        'vendor_bank_details_id' => null,
                        'date_range' => $release['Date Range'],
                        'transaction_number' => $c_transaction_nums[$release['Date Range']],
                        'amount' => $release['amount'],
                        'order_ids' => $release['order_ids']
                    ];
                    if (!empty($value['vendor']['vendor_bank'])) {
                        $new_data['vendor_bank_details_id'] = $release['vendor']['vendor_bank']['id'];
                        $condition = [
                            'vendor_bank_details_id' => $release['vendor']['vendor_bank']['id'],
                            'date_range' => $release['Date Range'],
                        ];
                        $transaction_exists = \App\Models\VendorSalesTransaction::where($condition)->first();
                        if (empty($transaction_exists)) {
                            $new = \App\Models\VendorSalesTransaction::create($new_data);
                        } else {
                            $transaction_exists->update($new_data);
                        }
                    }
                }
            }
        }
        // Breakdown of releases by date range and their items
        $releases_breakdown = $releases->groupBy(function ($release) {
            return $release->date_range;
            
        });
        
       // Breakdown of releases by date range and their items
        $release_items_by_date = $releases->mapWithKeys(function ($release) {
        $order_ids = explode(',', $release['order_ids']);

        $items = OrdersProduct::whereIn('order_id', $order_ids)
            ->whereNotIn('item_status', ['Pending Refund', 'Refunded', 'Refund Approved'])
            ->select('product_name', 'product_qty', 'product_price', 'item_status')
            ->get()
            ->groupBy('product_name')
            ->map(function ($itemsGroup) {
                return [
                    'total_qty' => $itemsGroup->sum('product_qty'),
                    'total_revenue' => $itemsGroup->sum(function ($item) {
                        return $item->product_price * $item->product_qty;
                    }),
                    'items' => $itemsGroup->map(function ($item) {
                        return [
                            'product_qty' => $item->product_qty,
                            'product_price' => $item->product_price,
                            'item_status' => $item->item_status,
                        ];
                    }),
                ];
            });

        $release_total_revenue = $items->sum('total_revenue');

        return [
            $release['Date Range'] => [
                'items' => $items,
                'total_revenue' => $release_total_revenue, 
            ],
            ];
        });

       $releases = $releases->map(function ($release) use ($release_items_by_date) {
        // Calculate the total revenue for the current release
        $release['amount'] = $release_items_by_date[$release['Date Range']]['total_revenue'] ?? 0;

        // Return the release only if it has revenue
        return ($release['amount'] > 0) ? $release : null;
        })->filter(function ($release) {
        // Remove null entries, which were releases without revenue
        return $release !== null;

});
        $releases = array_map(function ($value) {
        $vendor_bank_id = null;
        $vendor_bank_name = null;
        $vendor_bank_accnum = null;

        if (!empty($value['vendor']['vendor_bank'])) {
            $vendor_bank_id = $value['vendor']['vendor_bank']['id'];
            $vendor_bank_name = $value['vendor']['vendor_bank']['bank_name'];
            $vendor_bank_accnum = $value['vendor']['vendor_bank']['account_number'];
        }
        $condition = [
            'vendor_bank_details_id' => $vendor_bank_id,
            'date_range' => $value['Date Range'],
        ];
        $transaction_exists = \App\Models\VendorSalesTransaction::where($condition)
            ->whereNotIn('status', ['pending refund', 'refunded', 'refund approved']) // Exclude certain statuses
            ->first();

        return [
            'id' => empty($transaction_exists) ? false : $transaction_exists['id'],
            'Date Range' => $value['Date Range'],
            'amount' => $value['amount'],
            'shop_name' => \App\Models\VendorsBusinessDetail::where('vendor_id', $value['vendor']['id'])->first()->shop_name,
            'bank_name' => $vendor_bank_name,
            'transaction_number' => empty($transaction_exists) ? null : $transaction_exists['transaction_number'],
            'status' => empty($transaction_exists) ? false : $transaction_exists['status'],
            'account_number' => $vendor_bank_accnum,
        ];
    }, $releases->toArray());

        $date_dropdown_filter = collect($releases)->pluck('Date Range');

        $nextThursday = Carbon::now()->next(Carbon::THURSDAY)->format('M d Y');

        $digit4_accnum = null;
        if ($auth_type == 'vendor') {
            $vendor = auth()->guard('admin')->user()->load(['vendorBank']);
            if (!isNull($vendor->vendorBank)) {
                $account_number = $vendor->vendorBank->account_number;
                $digit4_accnum = substr($account_number, strlen($account_number)-4);
            }
        }
        return view('admin.reports.sales')->with(compact('revenue', 'order_count', 'buyers','releases','total_income','latest_payout','auth_type', 'date_dropdown_filter', 'nextThursday', 'digit4_accnum','productBreakdown','release_items_by_date'))
            ->with('top_items', $top_items);
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