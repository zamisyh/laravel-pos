<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Order_detail;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        session('successUpdate') ? toast(session('successUpdate'), 'success') : null;
        session('successDelete') ? toast(session('successDelete'), 'success') : null;
        $order = Order::orderBy('id', 'DESC')->with('customer', 'order_detail', 'order_detail.product.category')->get();
        $products = Product::all();
        return view('admin.order.index', compact('order', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $order = Order::find($id);
        $product = Product::find($request->product);

        $order->order_detail()->where('order_id', $id)->update([
            'product_id' => $request->product,
            'qty' => $request->qty,
            'status' => $request->status,
        ]);

        $order->total = $request->qty * $product->price;
        $product->stock = $product->stock - $request->qty + $request->qty2;




        $order->save();
        $product->save();

        return redirect()->back()->with('successUpdate', 'Successfully update!');





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req, $id)
    {
        $order = Order::findOrFail($id);
        $product = Product::findOrFail($req->prodid);

        $data = $product->stock + $req->qtyid;

        DB::table('products')->where('id', $product->id)->update([
            'stock' => $data
        ]);


        $order->delete();


        return redirect()->back()->with('successDelete', 'Succesfully delete!');
    }
}
