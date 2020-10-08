<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(3);
        return view('admin.user.index', compact('users'));
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
    public function changeStatus(Request $request, $id)
    {
        //
        // dd($request->all());
        $user = User::find($id);
        $user->update($request->all());
        return redirect()->route('user.index')->with('success', 'Cập nhật thành công');
    }
}
