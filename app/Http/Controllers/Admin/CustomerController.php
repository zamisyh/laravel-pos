<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        session('successAddCustomer') ? toast(session('successAddCustomer'), 'success') : toast(session('error'), 'danger');
        session('successUpdateCustomer') ? toast(session('successUpdateCustomer'), 'success') : toast(session('error'), 'danger');
        session('successDeleteCustomer') ? toast(session('successDeleteCustomer'), 'success') : toast(session('error'), 'danger');
        $customer = Customer::orderBy('created_at', 'DESC')->get();
        return view('admin.customer.index', compact('customer'));
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
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|min:9',
            'address' => 'required',
        ]);

        try {
            Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address
            ]);

            return redirect()->back()->with('successAddCustomer', 'Succesfully add customer');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
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

        $request->validate([
            'name' => 'max:100',
            'email' => 'email',
            'phone' => 'min:9',

        ]);

        $customer = Customer::find($id);

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        $customer->save();

        return redirect()->back()->with('successUpdateCustomer', 'Succesfully update Customer!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->back()->with('successDeleteCustomer', 'Success delete Customer!');
    }
}
