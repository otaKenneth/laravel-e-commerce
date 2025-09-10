<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity'
    ];

    // Relationship of a Cart Item `carts` table with a Product `products` table (every cart item belongs to a product)
    public function product() { // A Product `products` belongs to a Vendor `vendors`, and the Foreign Key of the Relationship is the `product_id` column
        return $this->belongsTo('App\Models\Product', 'product_id'); // 'product_id' is the Foreign Key of the Relationship
    }

    public function product_stock () {
        return $this->hasOne(ProductsAttribute::class, 'product_id', 'product_id')
            ->where(function ($query) {
                $query->where('size', $this->size)
                      ->where('color', $this->color);
            });
    }

    // Get the Cart Items of a cerain user (using their `user_id` if they're authenticated/logged in or their `session_id` if they're not authenticated/not logged in (guest))    
    public static function getCartItems($session_id) { // this method is called (used) in cart() method in Front/ProductsController.php
        // Get all Cart items of the user depending on whether the user is authenticated/logged in or logged out (Guest)
        $getCartItems = \App\Models\Cart::with([
                'product' => function ($query) {
                    $query->select('id', 'category_id', 'vendor_id', 'product_name', 'product_price', 'product_discount', 'product_code', 'product_image', 'product_weight', 'meta_keywords')
                        ->selectRaw('product_price - (product_price * product_discount / 100) AS discounted_price'); // Important Note: It's a MUST to select 'id' even if you don't need it, because the relationship Foreign Key `product_id` depends on it, or else the `product` relationship would give you 'null'!
                }
            ])->orderBy('id', 'Desc');

        if (Auth::guard('api')->check()) { // if the user is authenticated/logged in, get their cart items through their BOTH `user_id` and `session_id` in `carts` table
            $getCartItems->where([ // orderBy() method: https://laravel.com/docs/9.x/queries#orderby
                'user_id'    => Auth::guard('api')->user()->id // Through the `user_id` as the user is authenticated/logged in
            ]);

        } else { // if the user is NOT authenticated/logged out/Guest, get their cart items through their `session_id` ONLY (obviously `user_id` = 0 in this case) in `carts` table
            $getCartItems->where([ // orderBy() method: https://laravel.com/docs/9.x/queries#orderby
                'session_id' => $session_id 
            ]);
        }

        $resp = [];
        foreach ($getCartItems->get() as $key => $cartItem) {
            $temp_item = $cartItem->toArray();
            $temp_item['stock'] = $cartItem->product_stock ? $cartItem->product_stock->stock : 0;
            $resp[$key] = $temp_item;
        }

        return $resp;
    }

}