<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::with('category')->orderBy('created_at', 'DESC')->get();
        return view('client.home', compact('product'));
    }
}
