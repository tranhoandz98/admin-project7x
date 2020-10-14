<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $s_limit      = $request->limit ?? 5;
        $s_fullname   = $request->display_name;
        // dd($s_limit, $s_fullname, $s_role_user, $s_type_user, $s_created_at);
        // $roles = Role::all();
        // DB::enableQueryLog();
        $roles = Role::where(function ($query) use ($s_fullname) {
            if ($s_fullname) {
                $query->where('name', 'like', '%' . $s_fullname . '%')
                    ->orWhere('code', 'like', '%' . $s_fullname . '%');
            }
        })
            ->orderBy('created_at', 'desc')->paginate($s_limit);
        // and then you can get query log
        // dd(DB::getQueryLog());
        return view('page.admin.role.index', compact(
            // 'users',
            'roles',
            's_limit',
            's_fullname',
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
        $parents = Permission::distinct()->select('parent', 'parent_name')->get();
        $permissions = Permission::all();
        // dd($permission);
        return view('page.admin.role.create', compact('parents', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        // dd($request->all());
        $validated = $request->validated();
        $role = Role::create([
            'code' => $request->code,
            'name' => $request->name,
            'created_by' => 1,
            'description' => $request->description,

        ]);
        if ($request->has('permission')) {
            // dd($request->permission);
            foreach ($request->permission as $key => $value) {
                $role->permissions()->attach($value);
            }
            // dd('ok');
        }
        return redirect()->route('role.index')->with('success', 'Thêm mới thành công');
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
        //
        $role = Role::find($id);
        $permission_active = $role->permissions;
        // foreach ($permission_active as $key => $value) {
        //     # code...
        //     dump($value);
        // }
        // dd('ok');
        $parents = Permission::distinct()->select('parent', 'parent_name')->get();
        $permissions = Permission::all();
        // dd($permission);
        return view('page.admin.role.edit', compact('role', 'parents', 'permissions', 'permission_active'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        //
        $validated = $request->validated();
        $role = Role::find($id);
        // dd($role);
        $permisson_old = $role->permissions;
        // dd($permisson_old);
        // dd($permisson_old->count());
        if ($permisson_old->count() > 0) {
            foreach ($permisson_old as $key => $value) {
                $role->permissions()->detach($value);
            }
        }
        // dd($permisson_old);
        $role->update([
            'code' => $request->code,
            'name' => $request->name,
            'updated_at' => 1,
            'description' => $request->description,

        ]);
        if ($request->has('permission')) {
            // dd($request->permission);
            foreach ($request->permission as $key => $value) {
                $role->permissions()->attach($value);
            }
            // dd('ok');
        }
        return redirect()->route('role.index')->with('success', 'Cập nhật thành công');
    }

    public function destroyRole($id)
    {
        $role = Role::find($id);
        // $us$role->users;
        $countUser = $role->users->count();
        if ($countUser > 0) {
            return response()->json([
                'status' => '1',
                'message' => 'Không thể xóa Role'
            ],200);
        }
        // dd($countUser);
        // dd('not ok');
        $permisson_old = $role->permissions;
        if ($permisson_old->count() > 0) {
            foreach ($permisson_old as $key => $value) {
                $role->permissions()->detach($value);
            }
        }
        $role->delete();
        return response()->json([
            'status' => '2',
            'message' => 'Xóa role thành công'
        ],200);
    }
}
