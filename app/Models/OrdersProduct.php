<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrdersProduct extends Model
{
    use HasFactory;

    protected $table = 'orders_products';

    public function order () {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function order_product() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function product_category() {
        return $this->order_product->category();
    }

    public function vendor() {
        return $this->hasOne(Vendor::class, 'id', 'vendor_id');
    }

    public function product() {
        return $this->hasOne('\App\Models\Product', 'id', 'product_id')->with('category');
    }

    public static function hasUserOrderedThisProduct($user_id, $product_id) {
        return OrdersProduct::select('id')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('item_status', 'Delivered')
            ->get()->count() > 0 ? true:false;
    }

    public static function releaseHistory($vendor_id) {
        return OrdersProduct::with([
            'vendor.vendor_bank'
        ])
        ->selectRaw("
            CONCAT(
                DATE_FORMAT(DATE_SUB(created_at, INTERVAL (WEEKDAY(created_at) + 2) DAY), '%d %b'),
                ' - ',
                DATE_FORMAT(DATE_ADD(DATE_SUB(created_at, INTERVAL (WEEKDAY(created_at) + 2) DAY), INTERVAL 6 DAY), '%d %b %Y')
            ) AS `Date Range`,
            vendor_id,
            SUM(product_price * product_qty) as amount
        ")
        ->where('vendor_id', $vendor_id)
        ->whereHas('order', function ($query) {
            $query->where('order_status', '!=', 'Payment Pending'); // Ensure order is not pending
        })
        ->groupBy(DB::raw("`Date Range`, vendor_id"))
        ->get();
    }

    public static function totalIncome($vendor_id) {
        return OrdersProduct::join('vendors as v', 'orders_products.vendor_id', '=', 'v.id') // Join vendors to get commission
        ->selectRaw("
            orders_products.vendor_id,
            v.commission AS commission_rate,
            SUM(orders_products.product_price * orders_products.product_qty) AS revenue,
            SUM(orders_products.product_price * orders_products.product_qty) * v.commission AS total_fees_paid,
            SUM(orders_products.product_price * orders_products.product_qty) - (SUM(orders_products.product_price * orders_products.product_qty) * v.commission) AS total_income
        ")
        ->where('orders_products.vendor_id', $vendor_id)
        ->whereHas('order', function ($query) {
            $query->where('order_status', '!=', 'Payment Pending');
        })
        ->groupBy(DB::raw("orders_products.vendor_id, v.commission"))
        ->first(); // Use first() since total income is a single value
    }

    public static function latestPayout($vendor_id) {
        return OrdersProduct::with([
            'vendor.vendor_bank',
            'order'
        ])
        ->selectRaw("
            CONCAT(
                DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL (WEEKDAY(CURDATE()) + 9) DAY), '%d %b'),
                ' - ',
                DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL (WEEKDAY(CURDATE()) - 3) DAY), '%d %b %Y')
            ) AS `Date Range`,
            orders_products.vendor_id,
            SUM(orders_products.product_price * orders_products.product_qty) AS revenue
        ")
        ->where('orders_products.vendor_id', $vendor_id)
        ->whereBetween('orders_products.created_at', [
            DB::raw("DATE_SUB(CURDATE(), INTERVAL (WEEKDAY(CURDATE()) + 9) DAY)"), // Last week's Friday
            DB::raw("DATE_SUB(CURDATE(), INTERVAL (WEEKDAY(CURDATE()) - 3) DAY)")  // This week's Thursday
        ])
        ->whereHas('order', function ($query) {
            $query->where('order_status', '!=', 'Payment Pending');
        })
        ->groupBy(DB::raw("`Date Range`, orders_products.vendor_id"))
        ->first();
    }
    
}
