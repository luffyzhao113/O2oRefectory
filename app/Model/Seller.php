<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = ['name', 'status', 'verify'];

    public function verifies(){
        return $this->hasOne(SellerVerify::class, 'seller_id', 'id');
    }
}
