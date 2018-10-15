<?php

namespace App\Repositories\Modules\BaseCategory;

use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * delete
     * @param Model $model
     * @return bool|mixed
     * @throws \Exception
     * @author luffyzhao@vip.126.com
     */
    public function delete(Model $model)
    {
        parent::delete($model);
        $model->attributes()->delete();

        return true;
    }
}
