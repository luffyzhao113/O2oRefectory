<?php

namespace App\Repositories\Modules\SellerMaterial;

use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;
use Closure;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function whereHas($relation, Closure $callback = null, $operator = '>=', $count = 1){
        $this->model = $this->model->whereHas($relation, $callback, $operator, $count);
        return $this;
    }
}
