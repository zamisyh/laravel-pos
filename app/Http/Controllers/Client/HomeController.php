<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    public function index()
    {

        Paginator::useBootstrap();

        $product = Product::with('category')->orderBy('created_at', 'DESC')->paginate(3);
        return view('client.home', compact('product'));
    }
}
