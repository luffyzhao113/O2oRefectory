<?php

namespace App\Repositories\Modules\Seller;

use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function updateWhere(array $values, array $attributes){
        if(parent::updateWhere($values, $attributes)){
            $data = array_intersect_key($values, array_flip($this->model->getFillable()));
            $model = parent::findWhere(array_merge(
                $attributes, $data
            ));
            if(isset($values['logs'])){
                $model->logs()->create($values['logs']);
            }
        }else{
            return false;
        }
    }
}
