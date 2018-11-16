<?php

namespace App\Repositories\Modules\SellerAdmin;

use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function update(Model $model, array $values)
    {

        if (!(isset($values['password']) && $values['password'])) {
            unset($values['password']);
        }
        return parent::update($model, $values);
    }
}
