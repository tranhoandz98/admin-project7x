<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Http\Requests\ProvinceRequest;
use DateTime;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $s_limit      = $request->limit ?? 10;
        $s_fullname   = $request->display_name;
        $provinces = Province::where(function ($query) use ($s_fullname) {
            if ($s_fullname) {
                $query->where('fullname', 'like', '%' . $s_fullname . '%')
                    ->orWhere('code', 'like', '%' . $s_fullname . '%');
            }

        })->orderBy('created_at', 'desc')->paginate($s_limit);
        return view('page.admin.province.index', compact(
            // 'users',
            'provinces',
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
        return view('page.admin.province.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvinceRequest $request)
    {
        $date = new DateTime('');
        $provinces = Province::create([
            'code' => $request->code,
            'fullname' => $request->fullname,
            'short_name' => $request->short_name,
            'created_by' => 1,
            'isvalid' => (int)$request->status,
            'start_date' => $date,

        ]);
        return redirect()->route('province.index')->with('success', 'Thêm mới thành công');
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
        $province = Province::findOrFail($id);
        return view('page.admin.province.edit', compact('province'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProvinceRequest $request, $id)
    {
        //
        $province = Province::findorFail($id);
        $province->update([
            'code' => $request->code,
            'fullname' => $request->fullname,
            'short_name' => $request->short_name,
            'updated_by' => $province->updated_by + 1,
            'isvalid' => (int)$request->status,
        ]);
        return redirect()->route('province.index')->with('success', 'Cập nhật thành công');
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
    public function destroyProvince($id)
    {
        $date = new DateTime('');
        $province = Province::find($id);
        $countProvince = $province->districts->count();
        if ($countProvince > 0) {
            return response()->json([
                'status' => '1',
                'message' => 'Không thể xóa Province'
            ], 200);
        }
        $province->delete();
        return response()->json([
            'status' => '2',
            'message' => 'Xóa Province thành công'
        ], 200);
    }
}
