<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrdersProduct;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isNull;

class ReportsController extends Controller
{
    public function salesReports() {
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


        return view('admin.reports.sales')->with(compact('revenue', 'order_count', 'buyers','releases','total_income','latest_payout'));
    }
}