<?php

namespace App\Model;

use App\Observers\Model\BaseAuthObservers;
use Illuminate\Cache\TaggableStore;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;


class BaseAdmin extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = ['name', 'password', 'status', 'role_id', 'email', 'photo'];

    protected $hidden = ['password'];

    protected static function boot()
    {
        parent::boot();

        static::observe(BaseAuthObservers::class);
    }


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

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * 多对多关联角色表
     * @method role
     *
     * @return mixed
     *
     * @author luffyzhao@vip.126.com
     */
    public function role()
    {
        return $this->belongsTo(BaseRole::class,'role_id', 'id');
    }

    /**
     * cachedPermissions
     * @author luffyzhao@vip.126.com
     */
    public function cachedPermissions()
    {
        $cacheKey = 'BaseAdmin:cachedPermissions:'.$this->getKey();

        if ($this->attributes['role_id'] === 0) {
            if (Cache::getStore() instanceof TaggableStore) {
                return Cache::tags(['BaseAuth'])->remember(
                    $cacheKey,
                    Config::get('cache.ttl', 60),
                    function () {
                        return BasePermission::all();
                    }
                );
            } else {
                return BasePermission::all();
            }
        } else {
            if (Cache::getStore() instanceof TaggableStore) {
                return Cache::tags(['BaseAuth'])->remember(
                    $cacheKey,
                    Config::get('cache.ttl', 60),
                    function () {
                        return $this->role()->first()->cachedPermissions();
                    }
                );
            }else{
                return $this->role()->first()->cachedPermissions();
            }
        }
    }

    /**
     * 用户是否有权限
     * can
     * @param string $permission
     * @param bool $requireAll
     * @return bool
     * @author luffyzhao@vip.126.com
     */
    public function can($permission, $requireAll = false)
    {
        if($this->getAttribute('role_id') === 0){
            return true;
        }

        foreach ($this->cachedPermissions() as $perm) {
            if (str_is( $permission, $perm->name) ) {
                return true;
            }
        }

        return false;
    }
}
