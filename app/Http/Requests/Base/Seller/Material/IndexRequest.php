<?php

namespace App\Http\Requests\Base\Seller\Material;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'seller_id' => ['nullable', 'integer'],
            'status' => ['nullable', 'integer', 'in:0,1'],
        ];
    }

    public function attributes()
    {
        return [
            'seller_id' => '店铺名称',
            'status' => '资料状态'
        ];
    }
}
