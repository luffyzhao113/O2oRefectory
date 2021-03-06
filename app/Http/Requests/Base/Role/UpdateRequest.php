<?php

namespace App\Http\Requests\Base\Role;

use App\Model\BaseRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    protected $role;
    /**
     * 身份验证
     * @method authorize
     *
     * @return bool
     *
     * @author luffyzhao@vip.126.com
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
            'name' => ['required', 'string', 'between:2,50', Rule::unique('base_roles')->ignore($this->route('role'))],
            'status' => ['required', 'numeric', 'in:0,1'],
            'description' => ['nullable', 'string', 'max:200'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer'],
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
            'name' => '角色名称',
            'status' => '角色状态',
            'description' => '角色说明',
            'permissions.array' => '权限格式不正确！',
        ];
    }
}
