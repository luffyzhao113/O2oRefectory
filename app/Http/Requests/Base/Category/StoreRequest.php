<?php

namespace App\Http\Requests\Base\Category;

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
            'name' => ['required', 'min:2', 'max:10'],
            'parent_id' => ['required', 'integer'],
            'sort' => ['required', 'integer', 'between:0,999'],
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
    public function attributes()
    {
        return [
            'parent_id' => '所属上级',
            'name' => '类目名称',
            'sort' => '排序'
        ];
    }
}
