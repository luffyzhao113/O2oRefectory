<?php

namespace App\Http\Requests\Seller\Admin\Model;

use App\Model\SellerModel;
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
     * @param SellerModel $model
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function isSeller(SellerModel $model){
        if($model->getAttribute('seller_id') !== $this->input('seller_id')){
            $this->failedAuthorization();
        }
    }
}
