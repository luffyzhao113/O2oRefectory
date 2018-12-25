<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SellerGoodsDetail extends Model
{
    public $timestamps = false;

    protected $fillable = ['goods_id', 'content'];

    protected $primaryKey = 'goods_id';
}
