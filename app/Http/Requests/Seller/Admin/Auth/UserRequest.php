<?php

namespace App\Http\Requests\Seller\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return [
            'name' => ['required', 'string', 'between:2,10'],
            'email' => ['required', 'string', 'email', 'between:3,100', Rule::unique('seller_admins')->ignore(auth('seller')->user()->id)],
            'password' => ['nullable', 'between:6,20', 'confirmed'],
            'password_confirmation' => ['nullable', 'between:6,20'],
            'photo' => ['string', 'nullable']
        ];
    }

    /**
     * 字段中文名称
     * @method attributes
     *
     * @return array
     *
     * @author luffyzhao@vip.126.com
     */
    public function attributes(){
        return [
            'name' => '用户姓名',
            'email' => '登录邮箱',
            'password' => '用户密码',
            'password_confirmation' => '确认密码',
            'photo' => '头像'
        ];
    }
}
