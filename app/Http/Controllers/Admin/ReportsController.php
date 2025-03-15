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
                        'vendor_bank_details_id' => $release['vendor']['vendor_bank']['id'],
                        'date_range' => $release['Date Range'],
                        'transaction_number' => $c_transaction_nums[$release['Date Range']],
                        'amount' => $release['amount'],
                        'order_ids' => $release['order_ids']
                    ];
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