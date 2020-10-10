<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(){
        return view('page.admin.index');
    }
    public function login(){

        return view('page.admin.index');
    }
    public function postLogin(Request $request){
        // dd($request->all());
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])){
            return redirect()->route('admin');
        }
        else{
            return redirect()->back()->with('errors' , 'Tài khoản hoặc mật khẩu không chính xác');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('admin');
    }


}
