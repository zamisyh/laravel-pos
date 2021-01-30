<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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

       $role = Role::all();
       return view('admin.users.create', compact('role'));

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

            $user = User::create([
                'name' => $req->name,
                'email' => $req->email,
                'password' => bcrypt($req->password),
                'status' => true
            ]);

            $user->assignRole($req->role);

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


    public function rolePermission(Request $req)
    {
        $role = $req->get('role');

        $permissions = null;
        $hasPermission = null;

        $roles = Role::all()->pluck('name');

        if (!empty($role)) {

            $getRole = Role::findByName($role);
            $hasPermission = DB::table('role_has_permissions')
                ->select('permissions.name')
                ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                ->where('role_id', $getRole->id)->get()->pluck('name')->all();


            $permissions = Permission::all()->pluck('name');

        }


        return view('admin.users.role.role_permission', compact('roles', 'permissions', 'hasPermission'));
    }

    public function addPermission(Request $req)
    {
        // $req->validate([
        //     'permission' => 'required|string|unique:permission'
        // ]);

        $permission = Permission::firstOrCreate([
            'name' => $req->permission
        ]);

        return redirect()->back()->with('successPermission', 'Permission saved');
    }

    public function setRolePermission(Request $req, $role)
    {
        $role = Role::findByName($role);

         //fungsi syncPermission akan menghapus semua permissio yg dimiliki role tersebut
         //kemudian di-assign kembali sehingga tidak terjadi duplicate data

         $role->syncPermissions($req->permission);
         return redirect()->back()->with('successRole', 'Permission to Role saved!');

    }

}
