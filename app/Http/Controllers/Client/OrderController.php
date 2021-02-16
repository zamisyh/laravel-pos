<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\AddCustomerRequest;
use App\Http\Requests\Client\storeOrderRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order_detail;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class OrderController extends Controller
{
    public function orderDetails($id)
    {
        $product = Product::findOrFail($id);
        $product->with('category');
        return view('client.order', compact('product'));
    }

    public function checkout(Request $req, $id)
    {


        $req->validate([
            'email' => 'email|exists:customers,email',
        ], [
            'email.exists' => 'Email not found'
        ]);
        $customer = null;

        $email = $req->get('email');

        $email ? $customer = Customer::where('email', $email)->first() : null;

        session('successAddCustomer') ? toast(session('successAddCustomer'), 'success') : toast(session('error'), 'error');
        session('successCheckout') ? toast(session('successCheckout'), 'success') : toast(session('error'), 'error');
        $product = Product::findOrFail($id);
        $product->with('category');
        return view('client.checkout', compact('product', 'customer'));
    }

    public function addCustomer(AddCustomerRequest $req)
    {
        try {
            $customer = Customer::create([
                'name' => $req->name,
                'email' => $req->emailreg,
                'phone' => $req->phone,
                'address' => $req->address
            ]);

            if($customer){
                return redirect()->back()->with('successAddCustomer', 'Customer added!');
            }else{
                return redirect()->back()->with('errorAddCustomer', null);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function storeOrder(Request $req)
    {
        $order = Order::create([
            'invoice' => $this->generateInvoice(),
            'customer_id' => $req->idCustomer,
            'user_id' => Auth::user()->id,
            'total' => $req->price * $req->qty,
        ]);

       $order->order_detail()->create([
            'product_id' => $req->idProduct,
            'qty' => $req->qty,
            'price' => $req->price,
       ]);

       $product = Product::find($req->idProduct);
       $product->update([
            'stock' => $product->stock - $req->qty
       ]);

       return redirect()->back()->with('successCheckout', 'Order Succesfully');


    }

    public function generateInvoice()
    {
        $no = Order::max('id');
        $id = sprintf("%04s", abs($no + 1));
        return "INV"."-".$id;
    }
}
