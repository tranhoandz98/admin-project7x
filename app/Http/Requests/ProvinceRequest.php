<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProvinceRequest extends FormRequest
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
            'code' => 'required|unique:cs_category_province,code,'.$this->province,
            'fullname' => 'required|unique:cs_category_province,fullname,'.$this->province,
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
        ];
    }
}
