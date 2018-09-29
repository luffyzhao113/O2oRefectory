<?php

namespace App\Repositories\Modules\Seller;

use Illuminate\Support\Facades\DB;
use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Modules\SellerAdmin\Interfaces as SellerAdmin;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function updateWhere(array $values, array $attributes)
    {
        if (parent::updateWhere($values, $attributes)) {
            $data = array_intersect_key($values, array_flip($this->model->getFillable()));
            $model = parent::findWhere(
                array_merge(
                    $attributes,
                    $data
                )
            );
            if (isset($values['logs'])) {
                $model->logs()->create($values['logs']);
            }
        } else {
            return false;
        }
    }

    /**
     * create
     * @param array $attributes
     * @return bool|Model|mixed
     * @author luffyzhao@vip.126.com
     */
    public function create(array $attributes = [])
    {
        $model = parent::create($attributes);

        if (isset($attributes['admin'])) {
            $model->admin()->create($attributes['admin']);
        }

        return $model;
    }

    /**
     * update
     * @param Model $model
     * @param array $values
     * @return bool|Model|void
     * @author luffyzhao@vip.126.com
     */
    public function update(Model $model, array $values)
    {
        parent::update($model, $values);

        if (isset($values['admin'])) {
            $adminValues = $values['admin'];
            tap(
                $model->admin()->where('role_id', 0)->first(),
                function ($model) use ($adminValues) {
                    $repo = app(SellerAdmin::class);
                    $repo->update($model, $adminValues);
                }
            );
        }

    }
}
