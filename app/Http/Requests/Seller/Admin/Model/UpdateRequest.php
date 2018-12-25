<?php

namespace App\Http\Requests\Seller\Admin\Model;

use App\Model\SellerModel;
use Illuminate\Foundation\Http\FormRequest;

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
            'name' => ['required', 'min:2', 'max:20'],
            'description' => ['max:255'],
            'specs' => ['nullable', 'array'],
            'specs.*' => ['nullable', 'min:2', 'max:10'],
            'attributes' => ['required', 'array'],
            'attributes.*.name' => ['required', 'string',  'min:1', 'max:10'],
            'attributes.*.values' => ['required', 'array'],
            'attributes.*.values.*' => ['required','string', 'min:1', 'max:10'],
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '模型名称',
            'description' => '模型说明',
            'specs' => '模型规格',
            'specs.*' => '模型规格值',
            'attributes' => '关联属性',
            'attributes.*.name' => '属性名称',
            'attributes.*.values' => '属性值',
            'attributes.*.values.*' => '属性值',
        ];
    }

    /**
     * @param SellerModel $model
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function isSeller(SellerModel $model){
        if($model->getAttribute('seller_id') !== $this->input('seller_id')){
            $this->failedAuthorization();
        }
    }
}
