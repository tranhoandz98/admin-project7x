<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('page.admin.index');
    }
    public function login()
    {

        return view('page.admin.login');
    }
    public function postLogin(Request $request)
    {
        // dd($request->all());
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            return response()->json([
                'status' => 2,
                'message' => 'Đăng nhập thành công'
            ]);
        } else {
            return response()->json([
                'status' => 1,
                'message' => 'Tài khoản hoặc mật khẩu không chính xác'
            ]);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin');
    }
}
