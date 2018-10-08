<?php

namespace App\Http\Requests\Seller\Admin\Admin;

use App\Model\SellerAdmin;
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
     * @param SellerAdmin $admin
     * @return bool
     */
    public function isSuper(SellerAdmin $admin){
        if($admin->getAttribute('role_id') !== 0 && $admin->getAttribute('seller_id') === $this->input('seller_id')){
            return true;
        }

        $this->getValidatorInstance()->errors()->add('role_id', '管理员帐号不能在这里修改');
    }
}
