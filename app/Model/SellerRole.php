<?php

namespace App\Model;

use App\Observers\Model\SellerAuthObservers;
use Illuminate\Cache\TaggableStore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class SellerRole extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['name', 'status', 'description', 'seller_id'];

    protected static function boot()
    {
        parent::boot();

        static::observe(SellerAuthObservers::class);
    }

    /**
     * cachedPermissions
     * @return mixed
     * @author luffyzhao@vip.126.com
     */
    public function cachedPermissions(){
        $cacheKey = 'SellerRole:cachedPermissions:' . $this->getKey();

        if (Cache::getStore() instanceof TaggableStore) {
            return Cache::tags(['SellerAuth', 'SellerAuth:' . $this->getAttribute('seller_id')])->remember($cacheKey, Config::get('cache.ttl', 60), function () {
                return $this->perms()->get();
            });
        }else{
            return $this->perms()->get();
        }
    }

    /**
     * 多对多关联权限模型
     * @method perms
     *
     * @return mixed
     *
     * @author luffyzhao@vip.126.com
     */
    public function perms()
    {
        return $this->belongsToMany(SellerPermission::class, 'seller_permission_role', 'role_id', 'permission_id');
    }

    /**
     * 用户关联
     * users
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author luffyzhao@vip.126.com
     */
    public function users(){
        return $this->hasMany(SellerAdmin::class, 'role_id', 'id');
    }
}
