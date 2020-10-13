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
        foreach ($request->permission as $key => $value) {
            // dump($value);
            $permission = Permission::where('id',$request->permission)->first();
            // dump($permission);
            $role->permissions()->attach($permission);
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
}
