<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SellerAdmin extends Model
{
    protected $fillable = ['email', 'status', 'password', 'role_id', 'seller_id'];

    protected $hidden = ['password'];
    /**
     * 自动加密
     * @method setPasswordAttribute
     * @param $value
     *
     * @author luffyzhao@vip.126.com
     */
    protected function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
