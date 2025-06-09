<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrdersProduct;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isNull;
use Carbon\Carbon;
use App\Helpers\SalesHelper;
use Illuminate\Support\Str;

class ReportsController extends Controller
{
    public function salesReports(Request $request) {
     Session::put('page', 'income_statement');
        $vendor_ordersProduct = OrdersProduct::where('vendor_id', auth()->guard('admin')->user()->vendor_id);
        $get_Buyers = $vendor_ordersProduct;
        $get_topItems = $vendor_ordersProduct;
        $get_OrdersCnt = $vendor_ordersProduct;
        $releases = OrdersProduct::releaseHistory(auth()->guard('admin')->user()->vendor_id);
        $total_income = OrdersProduct::totalIncome(auth()->guard('admin')->user()->vendor_id);
        $latest_payout = OrdersProduct::latestPayout(auth()->guard('admin')->user()->vendor_id);
        
        if (!is_numeric($latest_payout)) {
            $latest_payout = 0.00;
        }
        
        $revenue = $vendor_ordersProduct
            ->whereNotIn('item_status', ['Pending Refund', 'Refunded', 'Refund Approved'])
            ->selectRaw('SUM(product_price * product_qty) as total_sales')
            ->value('total_sales');

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
            $transaction_exists = \App\Models\VendorSalesTransaction::where($condition)->first();
            return [
                'id' => empty($transaction_exists) ? false:$transaction_exists['id'],
                'Date Range' => $value['Date Range'],
                'amount' => $value['amount'],
                'shop_name' => \App\Models\VendorsBusinessDetail::where('vendor_id', $value['vendor']['id'])->first()->shop_name,
                'bank_name' => $vendor_bank_name,
                'transaction_number' => empty($transaction_exists) ? null:$transaction_exists['transaction_number'],
                'status' => empty($transaction_exists) ? false:$transaction_exists['status'],
                'account_number' => $vendor_bank_accnum,
            ];
        }, $releases->toArray());

        $date_dropdown_filter = collect($releases)->pluck(['Date Range']);

        $nextThursday = Carbon::now()->next(Carbon::THURSDAY)->format('M d Y');

        $digit4_accnum = null;
        if ($auth_type == 'vendor') {
            $vendor = auth()->guard('admin')->user()->load(['vendorBank']);
            if (!isNull($vendor->vendorBank)) {
                $account_number = $vendor->vendorBank->account_number;
                $digit4_accnum = substr($account_number, strlen($account_number)-4);
            }
        }
        
        return view('admin.reports.sales')->with(compact('revenue', 'order_count', 'buyers','releases','total_income','latest_payout','auth_type', 'date_dropdown_filter', 'nextThursday', 'digit4_accnum'));
    }

    
     public function generateWeeklyReport(Request $request)
    {
        try {
            $startOfWeek = now()->startOfWeek();
            $endOfWeek   = now()->endOfWeek();

            $orders = \App\Models\Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                            ->whereNotIn('order_status', ['Pending Refund', 'Refunded', 'Refund Approved'])
                            ->get()
                            ->groupBy('vendor_id');

            if ($orders->isEmpty()) {
                return response()->json(['status' => 0, 'message' => 'No transactions found.']);
            }

            foreach ($orders as $vendorId => $vendorOrders) {
                $amount = $vendorOrders->sum('total');
                $orderIds = $vendorOrders->pluck('id')->toArray();

                $bankDetails = \App\Models\VendorsBankDetail::where('vendor_id', $vendorId)->first();
                if (!$bankDetails) continue;

                \App\Models\VendorSalesTransaction::create([
                    'vendor_bank_details_id' => $bankDetails->id,
                    'date_range'             => $startOfWeek->format('Y-m-d') . ' to ' . $endOfWeek->format('Y-m-d'),
                    'transaction_number'     => strtoupper(Str::random(10)),
                    'amount'                 => $amount,
                    'status'                 => false,
                    'order_ids'              => json_encode($orderIds),
                ]);
            }

            return response()->json(['status' => 1, 'message' => 'Weekly report saved']);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function saveWeeklyReport(Request $request)
    {
        $startDate = Carbon::parse('2024-05-31')->startOfDay();
        $endDate = $startDate->copy()->addDays(6)->endOfDay(); // First 7-day range
        $currentDate = Carbon::now();

        // Loop through 7-day ranges until we reach the current date
        while ($endDate <= $currentDate) {
            $vendors = \App\Models\Vendor::with([
                'vendorProductOrders' => function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('created_at', [$startDate, $endDate])
                        ->whereNotIn('item_status', ['Payment Pending']);
                },
                'vendor_bank'
            ])->get();

            foreach ($vendors as $vendor) {
                $orderProducts = $vendor->vendorProductOrders;

                // Skip vendors with no orders or no bank details
                if ($orderProducts->isEmpty() || !$vendor->vendor_bank) {
                    continue;
                }

                $orderIds = $orderProducts->pluck('order_id')->unique()->values();
                $totalAmount = $orderProducts->sum('product_price');

                // Check if a transaction for this vendor and date range already exists
                $existingTransaction = \App\Models\VendorSalesTransaction::where('vendor_bank_details_id', $vendor->vendor_bank->id)
                    ->where('date_range', $startDate->format('M d') . ' - ' . $endDate->format('M d, Y'))
                    ->first();

                if ($existingTransaction) {
                    // If the transaction exists, update the existing record
                    $existingTransaction->update([
                        'amount' => $totalAmount, 
                        'order_ids' => json_encode($orderIds),
                        // Add any other fields that may have changed and need updating
                    ]);
                } else {
                    // If no transaction exists, create a new one
                    \App\Models\VendorSalesTransaction::create([
                        'vendor_bank_details_id' => $vendor->vendor_bank->id,
                        'date_range' => $startDate->format('M d') . ' - ' . $endDate->format('M d, Y'),
                        'transaction_number' => null, // Consider generating a unique transaction number here
                        'amount' => $totalAmount,
                        'status' => 0, // Adjust status value as needed
                        'order_ids' => json_encode($orderIds),
                    ]);
                }
            }

            // Move to the next 7-day range
            $startDate = $endDate->copy()->addDay(); // The next day after the current endDate
            $endDate = $startDate->copy()->addDays(6)->endOfDay(); // 7 days after the new startDate
        }

        return response()->json(['status' => 1, 'message' => 'Weekly reports generated up to the current date.']);
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