<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;


class HomeController extends Controller
{
    public function index()
    {
        $data['count']['customer'] = Customer::count();
        $data['count']['product'] = Product::count();
        $data['count']['total'] = Order::sum('total');
        $data['count']['order'] = Order::count();
        $data['count']['orderToday'] = Order::whereDate('created_at', Carbon::today())->count();

        Paginator::useBootstrap();

        $order = Order::select('*')->whereDate('created_at', Carbon::today())->with('customer', 'order_detail', 'order_detail.product')->get();
        $order_sold = Product::where('stock', 0)->paginate(5);
        return view('admin.home', $data, compact('order', 'order_sold'));
    }
}
