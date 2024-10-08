<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $primary_key = 'id';
    
    use HasFactory;

    public function admin() {
        return $this->belongsTo(Admin::class, 'id', 'vendor_id');
    }

    public function products() {
        return $this->hasMany('\App\Models\Product', 'vendor_id')->where([
            'status' => 1
        ]);
    }

    // Relationship of a Vendor `vendors` with VendorsBusinessDetail `vendors_business_details` (every product belongs to a vendor)    
    public function vendorbusinessdetails() {    
        return $this->belongsTo('App\Models\VendorsBusinessDetail', 'id', 'vendor_id'); // 'vendor_id' is the Foreign Key of the Relationship    // Defining The Inverse Of The Relationship: https://laravel.com/docs/9.x/eloquent-relationships#one-to-one-defining-the-inverse-of-the-relationship
    }



    
    public static function getVendorShop($vendorid) { // this method is called (used) in vendorListing() method in Front/ProductsController.php
        $getVendorShop = \App\Models\VendorsBusinessDetail::select('shop_name')->where('vendor_id', $vendorid)->first()->toArray();


        return $getVendorShop['shop_name'];
    }

    // Get Vendor's Commission Percentage that they must pay for the Website Owner from `commission` column of `vendors` table    
    public static function getVendorCommission($vendor_id) {
        $getVendorCommission = Vendor::select('commission')->where('id', $vendor_id)->first()->toArray();


        return $getVendorCommission['commission'];
    }

    public function chats() {
        return $this->belongsToMany(Chats::class, 'chat_messages', 'vendor_id', 'chat_id');
    }

    public function ratings() {
        return $this->products()
            ->with('ratings') // Eager load ratings to avoid N+1 problem
            ->get();
    }

    public function vendorProductRatings() {
        $avg_ratings = $this->products()
            ->with('ratings') // Eager load ratings to avoid N+1 problem
            ->get()
            ->flatMap(function ($product) {
                return $product->ratings;
            })
            ->avg('rating'); // Assuming the column in the ratings table is 'rating'
        
        return number_format($avg_ratings, 1);
    }
}