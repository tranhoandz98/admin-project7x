<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DistrictRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $arr =  [
            'code' => 'required|unique:cs_category_district,code,'.$this->district,
            'fullname' => 'required|unique:cs_category_district,fullname,'.$this->district,
            'province_id' => 'required',
        ];
        return $arr;
    }
    public function messages()
    {
        return [
            'fullname.required' => 'Tên không được bỏ trống',
            'fullname.unique' => 'Tên tỉnh đã tồn tại',
            'code.required' => 'Code không được bỏ trống',
            'code.unique' => 'Code đã tồn tại',
            'province_id.required' => 'Tỉnh thành không được bỏ trống',

        ];
    }
}
