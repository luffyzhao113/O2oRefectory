<?php

namespace App\Http\Requests\Base\Seller\Auditing;

use Illuminate\Foundation\Http\FormRequest;

class FailRequest extends FormRequest
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
            'remark' => ['required', 'max:200']
        ];
    }

    public function attributes()
    {
        return [
            'remark' => '审核不通过理由'
        ];
    }
}
