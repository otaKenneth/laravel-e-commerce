<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrdersProduct;
use Illuminate\Support\Facades\Session;

class ReportsController extends Controller
{
    public function salesReports() {
        Session::put('page', 'income_statement');
        $vendor_ordersProduct = OrdersProduct::where('vendor_id', auth()->guard('admin')->user()->vendor_id);
        
        $revenue = $vendor_ordersProduct
            ->whereNotIn('item_status', ['Pending Refund', 'Refunded', 'Refund Approved'])
            ->selectRaw('SUM(product_price * product_qty) as total_sales')
            ->value('total_sales');

        $buyers = $vendor_ordersProduct->selectRaw('COUNT(user_id) as count')->groupBy('user_id')->count();

        $top_items = $vendor_ordersProduct->selectRaw('COUNT(product_id) as count')->groupBy('product_id')->orderBy('count');

        $order_count = $vendor_ordersProduct->count();

        return view('admin.reports.sales')->with(compact('revenue', 'order_count', 'buyers'));
    }
}