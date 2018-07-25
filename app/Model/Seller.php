<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    /**
     * @var array 
     */
    protected $fillable = ['name', 'status'];

    /**
     * 审核证明
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function certificates(){
        return $this->hasOne(SellerCertificate::class, 'seller_id', 'id');
    }

    /**
     * 操作日志
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs(){
        return $this->hasMany(SellerLog::class, 'seller_id', 'id');
    }

    /**
     *  作用域-审核状态
     * @method scopeAuditing
     * @param Builder $query
     * @param $status
     * @return Builder
     * @author luffyzhao@vip.126.com
     */
    public function scopeAuditing(Builder $query, $status){
        if(is_array($status)){
            return $query->whereIn('auditing_status', $status);
        }
        return $query->where('auditing_status', '=', $status);
    }
}
