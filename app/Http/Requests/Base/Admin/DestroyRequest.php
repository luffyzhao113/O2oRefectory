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
     */
    public function isSuper(BaseAdmin $admin){
        if($admin->getAttribute('role_id') !== 0){
            return true;
        }

        $this->getValidatorInstance()->errors()->add('role_id', '管理员账号不能修改');
    }
}
