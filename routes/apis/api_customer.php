<?php

use Illuminate\Routing\Route;

Route::namespace('App\Http\Controllers\Front')->group(function() {
    Route::get('/', ['as' => 'home', 'uses' => 'IndexController@index']);
});