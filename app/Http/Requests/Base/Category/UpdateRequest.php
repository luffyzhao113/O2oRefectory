<?php

namespace App\Http\Requests\Base\Category;

use App\Model\BaseCategory;
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
            'sort' => '排序',
        ];
    }

    public function hasChild(BaseCategory $category)
    {
        if ($category->getAttribute('parent_id') !== $this->input('parent_id')) {
            if ($category->childs()->count() === 0) {
                if ($category->getAttribute('id') === $this->input('parent_id')) {
                    $this->failed('parent_id', '所属类目不能是类目本身。');
                }else{
                    return true;
                }
            }
        }

        $this->failed('parent_id', '类目下还有其他类目，不能更改所属上级。');
    }

    /**
     * failed
     * @param $key
     * @param $message
     * @author luffyzhao@vip.126.com
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failed($key, $message)
    {
        $validator = $this->getValidatorInstance();
        $validator->errors()->add($key, $message);
        $this->failedValidation($validator);
    }
}
