<?php

namespace App\Repositories\Modules\BaseRole;

use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * 修改
     * update
     * @param Model $model
     * @param array $values
     * @return bool|Model
     * @author luffyzhao@vip.126.com
     */
    public function update(Model $model, array $values)
    {
        $model = parent::update($model, $values);

        if(isset($values['permissions'])){
            $model->perms()->sync($values['permissions']);
        }

        return $model;
    }

    /**
     * 创建
     * create
     * @param array $attributes
     * @return bool|Model
     * @author luffyzhao@vip.126.com
     */
    public function create(array $attributes = [])
    {
        $model = parent::create($attributes);

        if(isset($attributes['permissions'])){
            $model->perms()->sync($attributes['permissions']);
        }

        return $model;
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
        // 先删除中间表
        $model->perms()->detach();
        return parent::delete($model);
    }
}
