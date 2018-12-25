<?php

namespace App\Http\Requests\Seller\Admin\Goods;

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
            'name' => ['required', 'min:2', 'max:50'],
            'bar_code' => [
                'required',
                'min:2',
                'max:20',
                Rule::unique('seller_goods', 'bar_code')->where('seller_id', $this->input('seller_id')),
            ],
            'price' => ['required', 'numeric', 'regex:/(^[1-9]\d*(\.\d{1,2})?$)|(^0(\.\d{1,2})?$)/'],
            'stock' => ['required', 'integer'],
            'sale' => ['required', 'integer'],
            'is_sale' => ['required', 'in:0,1'],
            'category_id' => ['required', Rule::exists('base_categories', 'id')],
            'image' => ['required', 'base64'],
            'images' => ['required', 'array', 'max:10'],
            'images.*.path' => ['required', 'base64'],
            'model_id' => [
                'nullable',
                'integer',
                Rule::exists('seller_models', 'id')->where('seller_id', $this->input('seller_id')),
            ],
            'attributes' => ['array'],
            'specs' => ['array'],
            'specs.*.specs' => ['required', 'array'],
            'specs.*.specs.*' => ['required', 'string'],
            'specs.*.price' => ['required', 'numeric', 'regex:/(^[1-9]\d*(\.\d{1,2})?$)|(^0(\.\d{1,2})?$)/'],
            'specs.*.stock' => ['required', 'integer'],
            'details' => ['nullable', 'array'],
            'details.content' => ['nullable', 'string', 'max:10000'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => '商品名称',
            'bar_code' => '商品条码',
            'price' => '商品价格',
            'stock' => '商品库存',
            'sale' => '商品销量',
            'is_sale' => '是否上架',
            'category_id' => '商品分类',
            'image' => '商品主图',
            'images' => '商品多图',
            'images.*.path' => '商品多图',
            'model_id' => '商品模型',
            'attributes' => '商品属性',
            'specs' => '商品规格',
            'specs.*.specs' => '商品规格',
            'specs.*.specs.*' => '商品规格',
            'specs.*.price' => '商品规格价格',
            'specs.*.stock' => '商品规格库存',
            'details' => '商品详情',
            'details.content' => '商品详情',
        ];
    }
}
