<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminCustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminAuth')->except('logout');
    }



    public function dashboard()
    {
        if (auth()->guard('admin')->user()) {

            $customers = Customer::all();
            $products = Product::all();
            $orders = Order::all();

            return view('auth.customer.home', ['customers' => $customers, 'products' => $products, 'orders' => $orders]);

        } else {
            abort(404);
        }
    }

}
