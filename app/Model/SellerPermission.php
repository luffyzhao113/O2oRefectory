<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SellerPermission extends Model
{
    protected $fillable = ['parent_id', 'name', 'icon', 'islink', 'display_name', 'description', 'sort'];

    /**
     * 作用域
     */
    public static function boot(){
        static::addGlobalScope('orderBy', function(Builder $builder) {
            $builder->orderBy('sort', 'ASC')->orderBy('id', 'DESC');
        });
    }
}
