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
}
