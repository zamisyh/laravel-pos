<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $req)
    {
        $customer = null;
        $order = null;
        $order_detail = null;
        $product = null;

        if($req->get('email')){
            $customer = Customer::where('email', $req->get('email'))->first();
            if($customer){
                $order = Order::select('*')->where('customer_id', $customer->id)->with('order_detail', 'customer', 'order_detail.product')->get();

            }else{
                return redirect()->back()->with('cNotFound', 'Email not registered!');
            }
        }

        return view('client.customer.index', compact('order'));
    }
}
