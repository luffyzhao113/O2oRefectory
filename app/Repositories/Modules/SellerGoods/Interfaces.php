<?php

namespace App\Repositories\Modules\SellerGoods;

use Illuminate\Database\Eloquent\Model;
use luffyzhao\laravelTools\Repositories\Facades\RepositoryInterface;

interface Interfaces extends RepositoryInterface
{
    public function restore(Model $model);
    
    public function onlyTrashed();
}
