<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|unique:users,name,'.$this->user,
            'code' => 'required',
            // 'phone' => 'required|max:15',
            'email' => 'required|unique:users,email,'.$this->user,
            'display_name' => 'required',
            'type' => 'numeric',
            'role_id' => 'numeric',
        ];
        if($this->has('password')){
            $arr['password'] = 'required';
            $arr['re_password'] = 'required|same:password';
        }
        return $arr;
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống',
            'name.unique' => 'Tên tài khoản đã tồn tại',
            'code.required' => 'Code không được bỏ trống',
            // 'phone.max' => 'Số điện thoại k vượt quá 15 kí tự',
            'email.required' => 'Email không được bỏ trống',
            'email.unique' => 'Email đã tồn tại',
            'display_name.required' => 'Display name không được bỏ trống',
            'password.required' => 'Mật khẩu không được bỏ trống',
            're_password.same' => 'Mật khẩu nhập lại không trùng khớp',
            're_password.required' => 'Mật khẩu nhập lại không được bỏ trống',
            'type.numeric' => 'Loại user không được bỏ trống',
            'role_id.numeric' => 'Quyền user không được bỏ trống',
        ];
    }
}
