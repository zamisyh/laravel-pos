<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SettingsController extends Controller
{
    public function homeChangePassword($id)
    {
        $data = User::findOrFail($id);

        // Auth::user()->id === $id ? return $data : return abort(404);

        session('smup') ? toast(session('smup'), 'success') : toast(session('emup'), 'error');
        return view('admin.setting.password.edit', compact('data'));
    }

    public function postChangePassword(Request $req, $id)
    {
        $req->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:new_password'
        ]);

        try {

            $data = User::where('id', Auth::user()->id)->first();
            $compare = password_verify($req->old_password, $data->password);

            if($compare === true){
                $data->password = bcrypt($req->new_password);
                $data->save();

                return redirect()->route('admin.setting.home.password', $id)->with('smup', 'Succesfully update password');
            }else{
                return redirect()->route('admin.setting.home.password', $id)->with('emup', 'Error, password dont match!');
            }

        } catch (\Exception $e) {
            return redirect()->route('admin.setting.home.password', $id)->with('emup', 'Error! : ' . $e->getMessage());
        }

    }
}
