<?php
// 6:35

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function index()
    {
        $data = ['nama' => 'login'];
        return view('admin.login.login', $data);
    }

    public function authenticate(Request $request)
    {
    }
}
