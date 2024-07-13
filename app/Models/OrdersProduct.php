<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersProduct extends Model
{
    use HasFactory;

    protected $table = 'orders_products';

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
}
