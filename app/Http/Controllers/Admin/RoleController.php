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
        $roles = Role::where(function ($query) use ($s_fullname) {
            if ($s_fullname) {
                $query->where('name', 'like', '%' . $s_fullname . '%')
                    ->orWhere('code', 'like', '%' . $s_fullname . '%');
            }
        })
            ->orderBy('created_at', 'desc')->paginate($s_limit);
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
        $validated = $request->validated();
        $role = Role::create([
            'code' => $request->code,
            'name' => $request->name,
            'created_by' => 1,
            'description' => $request->description,

        ]);
        if ($request->has('permission')) {
            foreach ($request->permission as $key => $value) {
                $role->permissions()->attach($value);
            }
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
        $permisson_old = $role->permissions;
        if ($permisson_old->count() > 0) {
            $role->permissions()->detach();
        }
        $role->update([
            'code' => $request->code,
            'name' => $request->name,
            'updated_at' => 1,
            'description' => $request->description,
        ]);
        if ($request->has('permission')) {
            foreach ($request->permission as $key => $value) {
                $role->permissions()->attach($value);
            }
        }
        return redirect()->route('role.index')->with('success', 'Cập nhật thành công');
    }
    public function destroyRole($id)
    {
        $role = Role::find($id);
        $countUser = $role->users->count();
        if ($countUser > 0) {
            return response()->json([
                'status' => '1',
                'message' => 'Không thể xóa Role'
            ], 200);
        }
        $permisson_old = $role->permissions;
        if ($permisson_old->count() > 0) {
            $role->permissions()->detach();
        }
        $role->delete();
        return response()->json([
            'status' => '2',
            'message' => 'Xóa role thành công'
        ], 200);
    }
}
