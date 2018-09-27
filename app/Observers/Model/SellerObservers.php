<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2018/9/27
 * Time: 10:39
 */

namespace App\Observers\Model;


use App\Model\Seller;

class SellerObservers
{
    /**
     * 更新或者新增完毕事件
     * saved
     * @author luffyzhao@vip.126.com
     * @param Seller $seller
     */
    public function saved(Seller $seller)
    {
        // 这里放缓存
        if($seller->wasRecentlyCreated){

        }
    }
}