<?php

use App\Http\Controllers\Auth\Admin\AdminController;
use App\Http\Controllers\Auth\Admin\NewsletterController;
use App\Http\Controllers\Auth\Admin\ProductsController;
use App\Http\Controllers\Auth\Customer\WishlistController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FrontEnd\BrandController;
use App\Http\Controllers\FrontEnd\CartController;
use App\Http\Controllers\FrontEnd\CheckOutController;
use App\Http\Controllers\FrontEnd\CompareController;
use App\Http\Controllers\FrontEnd\FrontEndController;
use App\Http\Controllers\FrontEnd\NewsController;
use App\Http\Controllers\FrontEnd\SendMailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Controllers\HttpConnectionHandler;

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

Route::view('/', 'pages.index')->name('index');

Auth::routes();

Route::post('/login', [LoginController::class, 'login'])->name('customerLogin');
Route::post('/login', [LoginController::class, 'postLogin'])->name('customerLoginPost');

Route::any('/register', [RegisterController::class, 'showRegistrationForm'])->name('registerCustom');
Route::post('/register', [RegisterController::class, 'register'])->name('registerPOST');
Route::get('/add-to-wishlist/{id?}', [WishlistController::class, 'addToWishlist'])->name('addwishlist');
Route::get('/remove-wishlist/{product?}/{id?}', [WishlistController::class, 'removeWish'])->name('removewish');
Route::get('/add-quantity/{product?}/{id?}',[CartController::class, 'addQuantity'])->name('addQuantity');
Route::get('/add-to-cart/{product?}/{id?}',[CartController::class, 'addToCart'])->name('addcart');
Route::get('/remove-qty/{product?}/{id?}',[CartController::class, 'removeToCart'])->name('removecart');
Route::get('/remove/{product?}/{id?}',  [CartController::class, 'remove'])->name('remove');


Route::get(env('APP_ADMIN_URL'),[AdminController::class, 'getLogin'])->name('adminLogin');
Route::post(env('APP_ADMIN_URL'), [AdminController::class, 'postLogin'])->name('adminLoginPost');

Route::post('send/product-request', [SendMailController::class, 'sendProduct'])->name('sendProduct');

Route::post('send/contact/form', [SendMailController::class, 'sendmail'])->name('sent');
Route::get('send/status/{status}', [SendMailController::class, 'sendSuccess'])->name('success');


Route::group(['middleware' => 'customer'], function () {
    Route::get('/home', [LoginController::class, 'showLoginForm'])->name('home');

});

