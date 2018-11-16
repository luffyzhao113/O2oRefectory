<?php

namespace App\Repositories\Modules\SellerGoods;

use luffyzhao\laravelTools\Repositories\Facades\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class Eloquent extends RepositoriesAbstract implements Interfaces
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return bool|Model
     */
    public function create(array $attributes = [])
    {
        $model = parent::create($attributes);

        $model->details()->create($attributes['details'] ?? []);

        if (array_key_exists('specs', $attributes)) {
            $model->specs()->createMany($attributes['specs']);
        }

        if (array_key_exists('images', $attributes)) {
            $model->images()->createMany($attributes['images']);
        }


        return $model;
    }

    /**
     * @param Model $model
     * @param array $values
     * @return bool|Model
     */
    public function update(Model $model, array $values)
    {
        $model = parent::update($model, $values);
        $model->details->fill($values['details'] ?? [])->save();

        $model->specs()->delete();
        $model->images()->forceDelete();

        if (array_key_exists('specs', $values)) {
            $model->specs()->createMany($values['specs']);
        }

        if (array_key_exists('images', $values)) {
            $model->images()->createMany($values['images']);
        }

        return $model;
    }

    /**
     * @param Model $model
     * @return
     */
    public function restore(Model $model)
    {
        // 下架
        $model->setAttribute('is_sale', 0);
        return $model->restore();
    }

    /**
     * @return $this
     */
    public function onlyTrashed(){
        $this->getQuery()->onlyTrashed();
        return $this;
    }
}
