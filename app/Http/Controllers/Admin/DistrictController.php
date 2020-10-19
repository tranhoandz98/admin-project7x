<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DistrictRequest;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Province;
use DateTime;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $provinces = Province::where('isvalid', 0)->get();
        $province_id = $request->province_id;
        $s_limit      = $request->limit ?? 10;
        $s_fullname   = $request->display_name;
        $districts = District::where(function ($query) use ($s_fullname) {
            if ($s_fullname) {
                $query->where('fullname', 'like', '%' . $s_fullname . '%')
                    ->orWhere('code', 'like', '%' . $s_fullname . '%');
            }
        })->where(function ($query) use ($province_id) {
            if ($province_id) {
                $query->where('province_id', $province_id);
            }
        })
            ->orderBy('created_at', 'desc')
            ->paginate($s_limit);
        return view('page.admin.district.index', compact(
            'districts',
            's_limit',
            's_fullname',
            'provinces',
            'province_id',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::where('isvalid', 0)->get();
        return view('page.admin.district.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistrictRequest $request)
    {
        $date = new DateTime('');
        $district = District::create([
            'code' => $request->code,
            'fullname' => $request->fullname,
            'short_name' => $request->short_name,
            'created_by' => 1,
            'isvalid' => (int)$request->status,
            'start_date' => $date,
            'province_id' => $request->province_id,
        ]);
        return redirect()->route('district.index')->with('success', 'Thêm mới thành công');
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
        $district = District::findOrFail($id);
        $provinces = Province::where('isvalid', 0)->get();
        return view('page.admin.district.edit', compact('provinces', 'district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DistrictRequest $request, $id)
    {
        //
        $district = District::findorFail($id);
        $district->update([
            'code' => $request->code,
            'fullname' => $request->fullname,
            'short_name' => $request->short_name,
            'updated_by' => $district->updated_by + 1,
            'isvalid' => (int)$request->status,
            'province_id' => $request->province_id,
        ]);
        return redirect()->route('district.index')->with('success', 'Cập nhật thành công');
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
    public function destroyDistrict($id)
    {
        $date = new DateTime('');
        $district = District::find($id);
        if ($district) {
            $district->delete();
            return response()->json([
                'status' => '1',
                'message' => 'Xóa district thành công'
            ], 200);
        }
        return response()->json([
            'status' => 2,
            'message' => 'Lỗi hệ thống'
        ]);
    }
}
