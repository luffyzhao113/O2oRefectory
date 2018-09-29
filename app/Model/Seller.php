<?php

namespace App\Model;

use App\Observers\Model\SellerObservers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    /**
     * @var array 
     */
    protected $fillable = ['name', 'status', 'domain'];


    protected static function boot()
    {
        parent::boot();

        static::observe(SellerObservers::class);
    }

    /**
     * 操作日志
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs(){
        return $this->hasMany(SellerLog::class, 'seller_id', 'id');
    }

    /**
     * 管理账号
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author luffyzhao@vip.126.com
     */
    public function admins(){
        return $this->hasMany(SellerAdmin::class, 'seller_id', 'id');
    }

    /**
     * 超级管理员
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author luffyzhao@vip.126.com
     */
    public function admin(){
        return $this->hasOne(SellerAdmin::class, 'seller_id', 'id')->where('role_id', 0);
    }
}
