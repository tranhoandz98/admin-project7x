<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // protected $id;
    // public function __construct($id)
    // {
    //     $this->id = $id;
    // }

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
        return [
            //
            'name' => ['required', Rule::unique('users')->ignore($this->user)],
            'code' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($this->user)],
            // 'phone' => [Rule::unique('users')->ignore($this->user)],
            'display_name' => 'required',
            'type' => 'numeric',
            'phone' => 'max:15',
            'role_id' => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.require' => 'Tên không được bỏ trống',
            'name.unique' => 'Tên tài khoản đã tồn tại',
            'code.require' => 'Code không được bỏ trống',
            'email.require' => 'Email không được bỏ trống',
            'phone.max' => 'Số điện thoại k vượt quá 15 kí tự',
            'email.unique' => 'Email đã tồn tại',
            // 'phone.unique' => 'Số điện thoại đã tồn tại',
            'display_name.require' => 'Display name không được bỏ trống',
            'type.numeric' => 'Loại user không được bỏ trống',
            'role_id.numeric' => 'Quyền user không được bỏ trống',
        ];
    }
}
