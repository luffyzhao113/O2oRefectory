<?php

namespace App\Http\Requests\Seller\Admin\Role;

use App\Model\SellerRole;
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
     * 验证规则
     * rules
     * @return array
     * @author luffyzhao@vip.126.com
     */
    public function rules(){
        return [];
    }

    /**
     * 是否有用户
     * hasUser
     * @param SellerRole $role
     * @author luffyzhao@vip.126.com
     * @return bool
     * @throws \Illuminate\Validation\ValidationException
     */
    public function hasUser(SellerRole $role){
       $usersCount = $role->getAttribute('users_count');

        if($usersCount === null){
            if($role->users()->count() === 0){
                return true;
            }
        }else if($usersCount === 0){
            return true;
        }

        $this->failed('user', '角色下还有用户不能删除');
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
