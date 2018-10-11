<?php

namespace App\Http\Requests\Base\Attribute;

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
            'name' => ['required', 'min:2', 'max:10'],
            'category_id' => ['required', Rule::exists('base_categories', 'id')],
            'values' => ['required', 'array', 'min:1', 'max:10'],
            'values.*.name' => ['required', 'min:2', 'max:10']
        ];
    }

    public function attributes()
    {
        return [
            'name' => '属性名称',
            'values' => '属性值',
            'values.*.name' => '属性值',
        ];
    }
}
