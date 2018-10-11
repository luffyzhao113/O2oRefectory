<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseAttributeValue extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'attribute_id'];


}
