<?php

namespace App\Repositories\Modules\BaseAttribute;

use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * create
     * @param array $attributes
     * @return bool|Model
     * @author luffyzhao@vip.126.com
     */
    public function create(array $attributes = [])
    {
        $model = parent::create($attributes);

        if(isset($attributes['values'])){
            $model->values()->createMany($attributes['values']);
        }

        return $model;
    }
}
