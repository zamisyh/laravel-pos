<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.users.role.index', compact('role'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'role' => 'required|string|max:50'
        ]);

        try {

            $role = Role::firstOrCreate([
                'name' => $req->role
            ]);

            return redirect()->route('admin.role.index')->with('success', 'Role ' . $role->name . ' Successfully added');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.role.index')->with('successDel', 'Successfully delete role ' . $role->name);
    }


}
