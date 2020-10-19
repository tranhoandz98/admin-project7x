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
use App\Http\Requests\UserRequest;
use App\Models\District;
use App\Models\Province;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     $users = User::orderBy('created_at','desc')->paginate(5);
    //     $roles = Role::all();
    //     return view('admin.user.index', compact('users','roles'));
    // }
    public function index(Request $request)
    {
        $s_limit      = $request->limit ?? 5;
        $s_fullname   = $request->display_name;
        $s_role_user  = $request->role_user;
        $s_type_user  = $request->type_user;
        $s_created_at = $request->created_at;
        $roles = Role::all();
        // dd($s_created_at);
        // DB::enableQueryLog();
        $users = User::where(function ($query) use ($s_fullname) {
            if ($s_fullname) {
                $query->where('display_name', 'like', '%' . $s_fullname . '%');
            }
        })
            ->where(function ($query) use ($s_type_user) {
                if ($s_type_user) {
                    $query->where('type_user', $s_type_user);
                }
            })
            ->where(function ($query) use ($s_created_at) {
                if ($s_created_at) {
                    $query->whereDate('created_at', '=', $s_created_at);
                }
            })
            ->whereHas('roles', function ($q) use ($s_role_user) {
                if ($s_role_user) {
                    $q->where('id', $s_role_user);
                }
            })
            ->orderBy('created_at', 'desc')->paginate($s_limit);
        // and then you can get query log
        // dd(DB::getQueryLog());
        return view('page.admin.user.index', compact(
            'users',
            'roles',
            's_limit',
            's_fullname',
            's_role_user',
            's_type_user',
            's_created_at'
        ));
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
        $provinces = Province::where('isvalid',0)->get();
        return view('page.admin.user.create', compact('roles', 'provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        $validated = $request->validated();
        $user = User::create([
            'name' => $request->name,
            'code' => $request->code,
            'email' => $request->email,
            'display_name' => $request->display_name,
            'department' => $request->department,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'type_user' => $request->type,
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'status' => 1,
        ]);
        // add key to user_role
        $role = Role::findOrFail($request->role_id);
        $user->roles()->attach($role);
        return redirect()->route('user.index')->with('success', 'Thêm mới thành công');
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
        $user = User::findOrFail($id);
        $districts = District::where('province_id', $user->province_id)
        ->where('isvalid',0)->get();
        $provinces = Province::where('isvalid',0)->get();
        return view('page.admin.user.edit', compact('user', 'roles', 'provinces', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $request->validated();
        $role = Role::findOrFail($request->role_id);
        $user = User::findOrFail($id);
        // delete user role old
        $role_old = $user->roles;
            $user->roles()->detach();
        // Update user
        $user->update([
            'name' => $request->name,
            'code' => $request->code,
            'email' => $request->email,
            'display_name' => $request->display_name,
            'department' => $request->department,
            'phone' => $request->phone,
            'type_user' => $request->type,
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'status' => 1,
        ]);
        // add role_user
        $user->roles()->attach($role);
        return redirect()->route('user.index')->with('success', 'Cập nhật thành công');
    }

    public function changeStatus($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 1) {
            $user->update([
                'status' => 2
            ]);
        } else {
            $user->update([
                'status' => 1
            ]);
        }
        return response()->json([
            'status'  => '1',
            'message' => 'Thay đổi thành công',
        ]);
    }
    public function getDistricts($id)
    {
        $districts = District::where('province_id', $id)
        ->where('isvalid',0)->get();
        return response()->json($districts);
    }
    public function destroyUser($id)
    {
        $user = User::find($id);
        // dd($user);
        if ($user) {
            $role_old = $user->roles;
            // dd('ok');
            if ($role_old){
                foreach ($role_old as $key => $value) {
                    $user->roles()->detach($value);
                }
            }
            $user->delete();
            return response()->json([
                'status' => 1,
                'message' => 'Xóa thành công'
            ]);
        }
        return response()->json([
            'status' => 2,
            'message' => 'Lỗi hệ thống'
        ]);
    }
}
