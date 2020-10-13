<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'code' => 'required|unique:users,code,'.$this->role,
            'name' => 'required|unique:users,name,'.$this->role,
            'description' => 'required',
        ];
        return $arr;
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống',
            'name.unique' => 'Tên tài khoản đã tồn tại',
            'code.required' => 'Code không được bỏ trống',
            'code.unique' => 'Code đã tồn tại',
            'description.required' => 'Mô tả không được bỏ trống',
        ];
    }
}
