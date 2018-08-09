<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SellerMaterial extends Model
{
    protected $fillable = ['name', 'seller_id'];

    public function seller(){
        return $this->belongsTo(Seller::class, 'seller_id', 'id');
    }
}
