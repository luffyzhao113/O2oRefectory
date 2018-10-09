<?php

namespace App\Http\Requests\Base\Admin;

use App\Model\BaseAdmin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    protected $admin;

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
     * @method rules
     *
     * @return array
     *
     * @author luffyzhao@vip.126.com
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'between:2,10'],
            'status' => ['required', 'numeric', 'in:0,1'],
            'email' => ['required', 'string', 'email', 'between:3,100', Rule::unique('base_admins')->ignore($this->route('admin'))],
            'role_id' => ['required', 'integer', 'min:1'],
            'password' => ['nullable', 'between:6,20', 'confirmed'],
            'password_confirmation' => ['nullable', 'between:6,20'],
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
    public function attributes(){
        return [
            'name' => '用户姓名',
            'status' => '用户状态',
            'email' => '登录邮箱',
            'role_id' => '角色ID',
            'password' => '用户密码',
            'password_confirmation' => '确认密码'
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
