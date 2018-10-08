<?php
/**
 * 商户有修改权限后把缓存清除
 * Created by PhpStorm.
 * User: luffyzhao
 * Date: 2018/10/8
 * Time: 20:34
 */

namespace App\Observers\Model;


use App\Model\SellerAdmin;
use App\Model\SellerPermission;
use App\Model\SellerRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SellerAuthObservers
{
    /**
     * @param Model $model
     */
    public function saved(Model $model){
        if($model instanceof SellerPermission){
            Cache::tags('SellerAuth')->flush();
        }else if($model instanceof SellerRole || $model instanceof SellerAdmin){
            Cache::tags('SellerAuth:' . $model->getAttribute('seller_id'))->flush();
        }
    }

    /**
     * @param Model $model
     */
    public function deleted(Model $model){
        if($model instanceof SellerPermission){
            Cache::tags('SellerAuth')->flush();
        }else if($model instanceof SellerRole || $model instanceof SellerAdmin){
            Cache::tags('SellerAuth:' . $model->getAttribute('seller_id'))->flush();
        }
    }
}