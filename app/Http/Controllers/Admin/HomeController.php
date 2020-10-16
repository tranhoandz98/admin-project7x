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
            return redirect()->route('admin');
        } else {
            return redirect()->back()->with('errors', 'Tài khoản hoặc mật khẩu không chính xác');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin');
    }
    public function showPer()
    {
        $user = Auth::user();
        $data = collect([
            'price' => 15,
            'dola' => 26,
            'sumo' => 36.
        ])->only(['price', 'dola']);
        // $collection = collect(['toidicode.com', 'Vu Thanh Tai', 'PHP'])
        //         ->filter(function ($key, $value) {
        //             return $value == 't';
        //         });
        // $collection = collect(['taylor', 'abigail', null])->map(function ($name) {
        //     return strtoupper($name);
        // })->reject(function ($name) {
        //     return empty($name);
        // });
        // $average = collect([['foo' => 10], ['foo' => 10], ['foo' => 20], ['foo' => 40]])->avg('foo');
        // $upper = $collection->toUpper();
        $collection = collect([
            ['name' => 'Desk', 'price' => 200],
            ['name' => 'Chair', 'price' => 100],
            ['name' => 'Bookcase', 'price' => 150],
        ]);

        $sorted = $collection->sortByDesc('price');

        // $sorted->values()->dd()->all();
        return view('page.admin.show');
    }
}
