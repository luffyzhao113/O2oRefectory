<?php

namespace App\Http\Requests\Seller\Admin\Banner;

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
            'name' => ['required', 'min:2', 'max:50'],
            'position' => ['required','min:2', 'max:10', 'regex:/[a-z]+[a-z0-9\-_]*/i'],
            'status' => ['required', 'numeric', 'in:0,1'],
            'banners' => ['required', 'array'],
            'banners.*.path' => ['required', 'base64'],
            'banners.*.title' => ['required',],
            'banners.*.link' => ['required',],
        ];
    }

    public function attributes()
    {
        return [
            'name' => '横幅名称',
            'position' => '横幅位置',
            'status' => '横幅状态',
            'banners' => '图片集',
            'banners.*.path' => '图片',
            'banners.*.title' => '图片标题',
            'banners.*.link' => '图片链接',
        ];
    }
}
