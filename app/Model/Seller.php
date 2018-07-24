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
}
