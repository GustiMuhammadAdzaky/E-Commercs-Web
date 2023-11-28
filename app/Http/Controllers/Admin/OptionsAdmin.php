<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\AdminModel;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

class OptionsAdmin extends Controller
{
    public function index()
    {
        $userModel = User::all();


        $data = [
            'nama' => 'Options',
            'userModel' => $userModel,
        ];
        return view("admin.options.optionsadmin", $data);
    }
    public function ubahAdmin(Request $request)
    {


        // Update data berdasarkan ID
        $admin = User::find($request->input('id'));
        $admin->name = $request->input('nama');
        $admin->email = $request->input('email');
        $admin->password = Hash::make($request->input('password'));


        $admin->save();

        return redirect('/optionsadmin')->with('status', 'Berhasil Diupdate');
    }
}
