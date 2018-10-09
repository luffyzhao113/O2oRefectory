<?php

namespace App\Http\Requests\Base\Admin;

use App\Model\BaseAdmin;
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
     * 验证是否超级管理员
     * @param BaseAdmin $admin
     * @return bool
     * @throws \Illuminate\Validation\ValidationException
     */
    public function isSuper(BaseAdmin $admin){
        if($admin->getAttribute('role_id') !== 0){
            return true;
        }

        $this->failed('role_id', '管理员账号不能修改');
    }

    /**
     * failed
     * @param $key
     * @param $message
     * @author luffyzhao@vip.126.com
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failed($key, $message){
        $validator =  $this->getValidatorInstance();
        $validator->errors()->add($key, $message);
        $this->failedValidation($validator);
    }
}
