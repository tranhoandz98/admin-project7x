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
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
        $s_limit      = $request->limit ?? 1;
        $s_fullname   = $request->display_name;
        $s_role_user  = $request->role_user;
        $s_type_user  = $request->type_user;
        $s_created_at = $request->created_at;
        // dd($s_limit, $s_fullname, $s_role_user, $s_type_user, $s_created_at);
        $roles = Role::all();
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
        //
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
        $provinces = Province::all();
        return view('page.admin.user.create', compact('roles', 'provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        //
        // dd($request->all());
        $validated = $request->validated();
        // dd($validated);
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
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
        ]);
        // add key to user_role
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
        $user = User::find($id);
        $districts = District::where('province_id',$user->province_id)->get();
        $provinces = Province::all();
        return view('page.admin.user.edit', compact('user', 'roles','provinces','districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        //
        $request->validated();
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
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
        ]);
        // add role_user
        $user->roles()->attach($role);
        return redirect()->route('user.index')->with('success', 'Cập nhật thành công');
    }

    public function changeStatus($id)
    {
        //
        // dd($request->all());
        $user = User::find($id);
        if ($user->status == 1) {
            $user->update([
                'status' => 2
            ]);
        } else {
            $user->update([
                'status' => 1
            ]);
        }
        return redirect()->route('user.index')->with('success', 'Cập nhật thành công');
    }
    public function getDistricts($id)
    {
        $districts = District::where('province_id', $id)
        ->get();
        // ->pluck("fullname","id");

        // dd(districts);
        return response()->json($districts);
    }
}
