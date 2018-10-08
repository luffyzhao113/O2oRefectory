<?php
/**
 * 平台后台有修改权限后把缓存清除
 * User: luffyzhao
 * Date: 2018/10/8
 * Time: 21:18
 */

namespace App\Observers\Model;


class BaseAuthObservers
{
    /**
     * @param Model $model
     */
    public function saved(Model $model){
        Cache::tags('BaseAuth')->flush();
    }

    /**
     * @param Model $model
     */
    public function deleted(Model $model){
        Cache::tags('BaseAuth')->flush();
    }
}