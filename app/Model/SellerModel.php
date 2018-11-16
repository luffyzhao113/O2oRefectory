<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellerModel extends Model
{
    use SoftDeletes;

    /**
     * 应该被调整为日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['seller_id', 'name', 'description', 'specs', 'attributes'];

    protected $casts = [
        'specs' => 'array',
        'attributes' => 'array',
    ];
}
