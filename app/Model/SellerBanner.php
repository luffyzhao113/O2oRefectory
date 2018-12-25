<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SellerBanner extends Model
{
    protected $fillable = ['name', 'position', 'banners', 'seller_id', 'status'];

    protected $casts = [
        'banners' => 'array'
    ];
    
}
