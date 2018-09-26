<?php

namespace App\Http\Requests\Base\Seller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => ['required', 'string', 'min:2', 'max:20'],
            'status' => ['required', 'in:0,1'],
            'domain' => ['required', 'string', Rule::unique('sellers')],
        ];
    }

    public function attributes()
    {
        return [
            'name' => '店铺名称',
            'status' => '店铺状态',
            'domain' => '二级域名',
        ];
    }
}
