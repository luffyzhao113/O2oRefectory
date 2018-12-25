<?php

namespace App\Repositories\Modules\SellerBanner;

use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes = [])
    {
        return parent::create($attributes);
    }
}
