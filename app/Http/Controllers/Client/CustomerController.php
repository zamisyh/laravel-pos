<?php

namespace App\Http\Controllers\Client;

use App\Exports\InvoiceExport;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\invoiceExcel;


class CustomerController extends Controller
{


    public function index(Request $req)
    {
        $customer = null;
        $order = null;
        $order_detail = null;
        $product = null;
        $idCus = null;

        if($req->get('email')){
            $customer = Customer::where('email', $req->get('email'))->first();
            if($customer){
                $order = Order::select('*')->where('customer_id', $customer->id)->with('order_detail', 'customer', 'order_detail.product')->get();
                $idCus = $customer->id;
            }else{
                return redirect()->back()->with('cNotFound', 'Email not registered!');
            }
        }

        return view('client.customer.index', compact('order', 'idCus'));
    }

    public function invoicePdf($id)
    {
        $order = Order::select('*')->where('customer_id', $id)->with('order_detail', 'order_detail.product')->get();
        $customer = Customer::find($id);
        $ordered = Order::where('customer_id', $id)->first();


        $pdf = PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
        ->loadView('client.customer.report.pdf', compact('order', 'customer', 'ordered'));

        return $pdf->download('invoice-'.$ordered->invoice.'.pdf');

    }

    public function invoiceExcel(Request $request, $id)
    {
        $ordered = Order::where('customer_id', $id)->first();
        return  Excel::download(new invoiceExcel($request->id), 'invoice-'.$ordered->invoice.'.xlsx');
    }
}
