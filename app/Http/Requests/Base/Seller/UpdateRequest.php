<?php

namespace App\Http\Requests\Base\Seller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:20'],
            'status' => ['required', 'in:0,1'],
            'domain' => ['required', 'string', Rule::unique('sellers')->ignore($this->route('seller'))],
            'admin.email' => ['required', 'string', 'email', Rule::unique('seller_admins', 'email')->whereNot('seller_id', $this->route('seller'))->where('role_id', 0)],
            'admin.password' => ['required', 'string', 'min:6', 'max:20', 'confirmed'],
            'admin.password_confirmation' => ['required', 'string', 'min:6', 'max:20']
        ];
    }

    public function attributes()
    {
        return [
            'name' => '店铺名称',
            'status' => '店铺状态',
            'domain' => '二级域名',
            'admin.email' => '登录账号',
            'admin.password' => '登录密码',
            'admin.password_confirmation' => '确认密码',
        ];
    }
}
