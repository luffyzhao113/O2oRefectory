<?php

namespace App\Model;

use App\Observers\Model\BaseAuthObservers;
use Illuminate\Cache\TaggableStore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class BaseRole extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'status', 'description'];

    protected static function boot()
    {
        parent::boot();

        static::observe(BaseAuthObservers::class);
    }

    
    /**
     * cachedPermissions
     * @return mixed
     * @author luffyzhao@vip.126.com
     */
    public function cachedPermissions(){
        $cacheKey = 'BaseRole:cachedPermissions:' . $this->getKey();

        if (Cache::getStore() instanceof TaggableStore) {
            return Cache::tags(['BaseAuth'])->remember($cacheKey, Config::get('cache.ttl', 60), function () {
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
        return $this->belongsToMany(BasePermission::class, 'base_permission_role', 'role_id', 'permission_id');
    }

    /**
     * 用户模型
     * @method users
     *
     * @return mixed
     *
     * @author luffyzhao@vip.126.com
     */
    public function users()
    {
        return $this->hasMany(BaseAdmin::class, 'role_id', 'id');
    }
}
