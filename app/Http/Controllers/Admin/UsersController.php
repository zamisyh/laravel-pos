<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        session('successMsgCreate') ? toast(session('successMsgCreate'), 'success') : toast(session('errorMsgCreate'), 'error');
        session('successMsgDelete') ? toast(session('successMsgDelete'), 'success') : toast(session('errorMsgDelete'), 'error');
        session('successMsgUpdate') ? toast(session('successMsgUpdate'), 'success') : toast(session('errorMsgUpdate'), 'error');

        $users = User::all();
        return view('admin.users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(session('errorMsgCreate')){
            toast(session('errorMsgCreate'), 'error');
        }

        return view('admin.users.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $req)
    {
        try {

            User::create([
                'name' => $req->name,
                'email' => $req->email,
                'password' => bcrypt($req->password)
            ]);

            return redirect()->route('admin.users.index')->with('successMsgCreate', 'Successfully created data!');

        } catch (\Exception $e) {
            return redirect()->route('admin.users.create')->with('errorMsgCreate', 'error : ' . $e->getMessage());
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
        $data = User::find($id);
        return view('admin.users.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $req, $id)
    {
        try {

            $data = User::findOrFail($id);

            $data->name = $req->name;
            $data->email = $req->email;

            $data->save();

            return redirect()->route('admin.users.index')->with('successMsgUpdate', 'Succesfully update!');


        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('errorMsgUpdate', 'Error : ' . $e->getMessage() );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.users.index')->with('successMsgDelete', 'Succesfully delete');
    }
}
