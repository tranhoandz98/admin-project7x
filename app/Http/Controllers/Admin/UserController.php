<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('created_at','desc')->paginate(5);
        $roles = Role::all();
        return view('admin.user.index', compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'email' => 'required|unique:users',
            'display_name' => 'required',
            'password' => 'required',
            're_password' => 'required',
            'type' => 'numeric',
            'role_id' => 'numeric',
        ], [
            'name.require' => 'Tên không được bỏ trống',
            'code.require' => 'Code không được bỏ trống',
            'email.require' => 'Email không được bỏ trống',
            'email.unique' => 'Email đã tồn tại',
            'display_name.require' => 'Display name không được bỏ trống',
            'password.require' => 'Mật khẩu không được bỏ trống',
            're_password.require' => 'Mật khẩu không được bỏ trống',
            'type.numeric' => 'Loại user không được bỏ trống',
            'role_id.numeric' => 'Quyền user không được bỏ trống',
        ]);
        $role = Role::findOrFail($request->role_id);
        $user = User::create([
            'name' => $request->name,
            'code' => $request->code,
            'email' => $request->email,
            'display_name' => $request->display_name,
            'department' => $request->department,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'type_user' => $request->type,
        ]);
        // add key to user_role
        $user->roles()->attach($role);
        return redirect()->route('user.index')->with('success', 'Thêm mới thành công');
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
        $roles = Role::all();
        $user = User::find($id);
        // dd($users);
        // dd($user->roles);
        return view('admin.user.edit', compact('user', 'roles'));
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
        //
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($id)],
            'phone' => [Rule::unique('users')->ignore($id)],
            'display_name' => 'required',
            'type' => 'numeric',
            'role_id' => 'numeric',
        ], [
            'name.require' => 'Tên không được bỏ trống',
            'code.require' => 'Code không được bỏ trống',
            'email.require' => 'Email không được bỏ trống',
            'email.unique' => 'Email đã tồn tại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'display_name.require' => 'Display name không được bỏ trống',
            'type.numeric' => 'Loại user không được bỏ trống',
            'role_id.numeric' => 'Quyền user không được bỏ trống',
        ]);
        $role = Role::findOrFail($request->role_id);
        $user = User::find($id);
        // delete user role old
        $role_old = $user->roles;
        foreach ($role_old as $key => $value) {
            $user->roles()->detach($value);
        }
        // Update user
        $user->update([
            'name' => $request->name,
            'code' => $request->code,
            'email' => $request->email,
            'display_name' => $request->display_name,
            'department' => $request->department,
            'phone' => $request->phone,
            'type_user' => $request->type,
        ]);
        // add role_user
        $user->roles()->attach($role);
        return redirect()->route('user.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function changeStatus($id)
    {
        //
        // dd($request->all());
        $user = User::find($id);
        if ($user->status ==1){
            $user->update([
                'status' => 2
            ]);
        }
        else{
            $user->update([
                'status' => 1
            ]);
        }
        return redirect()->route('user.index')->with('success', 'Cập nhật thành công');
    }
    public function search(Request $request){
        $s_limit      = $request->limit ?? 5;
        $s_fullname   = $request->display_name;
        $s_role_user  = $request->role_user;
        $s_type_user  = $request->type_user;
        $s_created_at = $request->created_at;
        // dd($s_limit, $s_fullname, $s_role_user,$s_type_user, $s_created_at);
        $roles = Role::all();
        // DB::enableQueryLog();
        $users = User::
        where(function ($query) use ($s_fullname) {
                if($s_fullname){
                 $query->where('display_name','like', '%'.$s_fullname.'%');
                }
            })
            ->where(function ($query) use ($s_type_user) {
                if($s_type_user){
                 $query->where('type_user',$s_type_user);
                }
            })
            ->where(function ($query) use ($s_created_at) {
                if($s_created_at){
                 $query->whereDate('created_at', '=', $s_created_at);
                }
            })
        ->whereHas('roles', function($q) use($s_role_user){
            if($s_role_user){
                $q->where('id',$s_role_user);
               }
        })
        ->orderBy('created_at','desc')->paginate($s_limit);
        // and then you can get query log
        // dd(DB::getQueryLog());
        return view('admin.user.search', compact('users','roles','s_limit','s_fullname','s_role_user','s_type_user','s_created_at' ));
    }
}
