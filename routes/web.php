<?php

use App\Http\Controllers\Auth\Admin\AdminController;
use App\Http\Controllers\Auth\Admin\ConfirmEmailController;
use App\Http\Controllers\Auth\Admin\LogActivityController;
use App\Http\Controllers\Auth\Admin\ProductsController;
use App\Http\Controllers\Auth\Admin\ProfileAdminController;
use App\Http\Controllers\Auth\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
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
Route::redirect('/', '/admin-login');
Auth::routes(['verify' => true]);
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed']);
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('adminLoginPost');

Route::any('/register', [RegisterController::class, 'showRegistrationForm'])->name('registerCustom');
Route::post('/register', [RegisterController::class, 'register'])->name('registerPOST');


Route::post('send/product-request', [SendMailController::class, 'sendProduct'])->name('sendProduct');

Route::post('send/contact/form', [SendMailController::class, 'sendmail'])->name('sent');
Route::get('send/status/{status}', [SendMailController::class, 'sendSuccess'])->name('success');
Route::resource('users', UserController::class);
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['verified']], function () {

        Route::resource('products', ProductsController::class);
//    Route::any('users/{id?}', [UserController::class, 'store'])->name('userA.store');
        Route::get('/products/duplicate/{id}', [ProductsController::class, 'duplicate'])->name('products.duplicate');
//    Route::delete('/remove/{product?}',[ProductsController::class, 'remove2'])->name('remove.pro');
//    Route::delete('/remove2/{product?}',[ProductsController::class, 'remove3'])->name('remove.pro3');
        Route::any('/products/remove1/{id}/{product?}', [ProductsController::class, 'remove1'])->name('remove1');
        Route::any('/products/remove2/{id}/{product?}', [ProductsController::class, 'remove2'])->name('remove2');
        Route::any('/products/remove3/{id}/{product?}', [ProductsController::class, 'remove3'])->name('remove3');
        Route::any('/products/remove-attachment/{id}/{product?}', [ProductsController::class, 'removeAttachment'])->name('removeAttachment');

        Route::view('/forms', 'auth.admin.forms')->name('forms');
        Route::any('/logs', [LogActivityController::class, 'index'])->name('logActivity');
        Route::any('/admin-logs', [LogActivityController::class, 'admin'])->name('AdminLogActivity');
        Route::get('/archived-users', [AdminController::class, 'archivedUsers'])->name('archivedUsers');

        Route::get('profile', [ProfileAdminController::class, 'index'])->name('profileAdmin');
        Route::any('profile/{id?}', [ProfileAdminController::class, 'update'])->name('updateAdmin');
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('shipments', [AdminController::class, 'shipments'])->name('shipments');

        // logout
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/home', [LoginController::class, 'showLoginForm'])->name('home');

    });
});
