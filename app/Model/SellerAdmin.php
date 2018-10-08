<?php

namespace App\Model;

use Illuminate\Cache\TaggableStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SellerAdmin extends Authenticatable implements JWTSubject
{
    /**
     * @var array
     */
    protected $fillable = ['email', 'status', 'password', 'role_id', 'seller_id', 'name', 'photo'];

    /**
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * 自动加密
     * @method setPasswordAttribute
     * @param $value
     *
     * @author luffyzhao@vip.126.com
     */
    protected function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * getJWTIdentifier
     * @return mixed
     * @author luffyzhao@vip.126.com
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * getJWTCustomClaims
     * @return array
     * @author luffyzhao@vip.126.com
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * cachedPermissions
     * @author luffyzhao@vip.126.com
     */
    public function cachedPermissions()
    {
        $cacheKey = 'SellerAdmin:cachedPermissions:'.$this->getKey();

        if ($this->attributes['role_id'] === 0) {
            if (Cache::getStore() instanceof TaggableStore) {
                return Cache::tags('BaseAuth')->remember(
                    $cacheKey,
                    Config::get('cache.ttl', 60),
                    function () {
                        return SellerPermission::all();
                    }
                );
            } else {
                return SellerPermission::all();
            }
        } else {
            if (Cache::getStore() instanceof TaggableStore) {
                return Cache::tags('BaseAuth')->remember(
                    $cacheKey,
                    Config::get('cache.ttl', 60),
                    function () {
                        return $this->role->cachedPermissions();
                    }
                );
            }else{
                return $this->role->cachedPermissions();
            }
        }
    }

    /**
     * 角色
     * role
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @author luffyzhao@vip.126.com
     */
    public function role()
    {
        return $this->belongsTo(SellerRole::class, 'role_id', 'id');
    }
}
