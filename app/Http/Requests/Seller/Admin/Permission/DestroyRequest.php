<?php

namespace App\Http\Requests\Seller\Admin\Permission;

use App\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

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
     * 添加验证后钩子
     * @method withValidator
     * @param Validator $validator
     *
     * @author luffyzhao@vip.126.com
     */
    public function withValidator(Validator $validator){
        $validator->after(function ($validator) {
            if (!$this->hasChild()) {
                $validator->errors()->add('islink', '菜单还有下级不能修改成权限');
            }
        });
    }

    /**
     * 权限不能有下级
     * @method linkForParent
     *
     * @return bool
     *
     * @author luffyzhao@vip.126.com
     */
    protected function hasChild(){
        return DB::table('seller_permissions')->where('parent_id', $this->route('permission'))->count() === 0;
    }

    /**
     * 验证规则
     * @method rules
     *
     * @return array
     *
     * @author luffyzhao@vip.126.com
     */
    public function rules(){
        return [];
    }
}
