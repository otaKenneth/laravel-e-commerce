<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Front')->group(function() {
    Route::post('user/login', 'UserController@userLogin');
    Route::post('forgot-password', 'UserController@forgotPassword');
    Route::prefix('user')->middleware('auth:api')->group(function () {
        Route::post('logout', 'UserController@userLogout');
        Route::post('profile', 'UserController@userAccount');
        Route::patch('update-password', 'UserController@userUpdatePassword');
        Route::get('delivery-addresses', 'UserController@showDeliveryAddresses');
        Route::post('delivery-addresses', 'AddressController@saveDeliveryAddress');
        Route::delete('delivery-addresses/{delivery_address}', 'AddressController@removeDeliveryAddress');
    });

    Route::prefix('cart')->group(function () {
        // Render Cart page (front/products/cart.blade.php)    // this route is accessed from the <a> HTML tag inside the flash message inside cartAdd() method in Front/ProductsController.php (inside front/products/detail.blade.php)
        Route::get('', 'ProductsController@cart');
        
        // Add to Cart <form> submission in front/products/detail.blade.php
        Route::post('add', 'ProductsController@cartAdd');
    
        // Update Cart Item Quantity AJAX call in front/products/cart_items.blade.php. Check front/js/custom.js
        Route::post('update', 'ProductsController@cartUpdate');
    
        // Delete a Cart Item AJAX call in front/products/cart_items.blade.php. Check front/js/custom.js
        Route::post('delete', 'ProductsController@cartDelete');
    });
});

Route::namespace('App\Http\Controllers\API')->group(function () {
    // API Endpoint:    GET http://
    Route::get('index', 'V2_IndexController@index');
    Route::get('product_image', 'V2_ProductsController@image');
    Route::get('filters', 'V2_ProductsController@availableFilters');
    Route::prefix('product')->group(function () {
        Route::get('{product}', 'V2_ProductsController@detail');
        Route::get('/related/{product}', 'V2_ProductsController@relatedProducts');
        Route::get('/reviews/{product}', 'V2_ProductsController@reviews');
    });
    
    Route::prefix('products')->group(function () {
        // Product listing with filters (GET)
        Route::get('{type}/{any?}', 'V2_ProductsController@listing')
        ->where('any', '.*');
        
        // // Product detail (GET)
        // Route::get('detail/{id}', [V2_ProductsController::class, 'detail']);

        // // Get product price for attribute changes (POST)
        // Route::get('price', [V2_ProductsController::class, 'getProductPrice']);
    });

    // New Vendor Routes
    Route::get('vendors', 'V2_VendorController@index');
    Route::post('become_merchant', 'V2_VendorController@register');
    Route::get('vendors/{id}', 'V2_VendorController@show');
    Route::get('vendor/confirm/{email}', 'V2_VendorController@confirmVendor');
});