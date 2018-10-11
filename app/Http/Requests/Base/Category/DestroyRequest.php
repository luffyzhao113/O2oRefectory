<?php

namespace App\Http\Requests\Base\Category;

use App\Model\BaseCategory;
use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
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
            //
        ];
    }

    /**
     * hasChild
     * @param BaseCategory $category
     * @return bool
     * @throws \Illuminate\Validation\ValidationException
     * @author luffyzhao@vip.126.com
     */
    public function hasChild(BaseCategory $category){
        if ($category->childs()->count() !== 0) {
            $this->failed('child', '类目还有下级不能删除');
        }

        if($category->goods()->count() !== 0){
            $this->failed('child', '类目还有商品不能删除');
        }

        return true;
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
