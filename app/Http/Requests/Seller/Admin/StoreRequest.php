<?php

namespace App\Http\Requests\Seller\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6', 'max:20']
        ];
    }

    /**
     * 字段中文名称
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => '用户邮箱',
            'password' => '用户密码',
        ];
    }
}
