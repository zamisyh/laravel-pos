<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order_detail;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;

class OrderController extends Controller
{
    public function orderDetails($id)
    {
        $product = Product::findOrFail($id);
        $product->with('category');
        return view('client.order', compact('product'));
    }

    public function checkout($id)
    {
        return view('client.checkout');
    }
}
