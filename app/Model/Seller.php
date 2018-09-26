<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    /**
     * @var array 
     */
    protected $fillable = ['name', 'status', 'domain'];

    /**
     * 操作日志
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs(){
        return $this->hasMany(SellerLog::class, 'seller_id', 'id');
    }
}
