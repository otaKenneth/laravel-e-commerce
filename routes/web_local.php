<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/better-pay', [App\Http\Controllers\BetterPayController::class, 'index']);
Route::post('/better-pay', [App\Http\Controllers\BetterPayController::class, 'store'])->name('better-pay.store');

require __DIR__ . '/auth.php';



// Note: OUR WEBSITE WILL HAVE TWO MAJOR SECTIONS: ADMIN ROUTES (for the Admin Panel) & FRONT ROUTES (for the Frontend section routes)!:

// First: Admin Panel routes:
// The website 'ADMIN' Section: Route Group for routes starting with the 'admin' word (Admin Route Group)    // NOTE: ALL THE ROUTES INSIDE THIS PREFIX STATRT WITH 'admin/', SO THOSE ROUTES INSIDE THE PREFIX, YOU DON'T WRITE '/admin' WHEN YOU DEFINE THEM, IT'LL BE DEFINED AUTOMATICALLY!!
require __DIR__ . "/web_admin.php";

// User download order PDF invoice (We'll use the same viewPDFInvoice() function (but with different routes/URLs!) to render the PDF invoice for 'admin'-s in the Admin Panel and for the user to download it!) (we created this route outside outside the Admin Panel routes so that the user could use it!)
Route::get('orders/invoice/download/{id}', 'App\Http\Controllers\Admin\OrderController@viewPDFInvoice');

require __DIR__ . "/web_customer.php";
