<?php

namespace App\Model;

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
    public function roles()
    {
        return $this->belongsTo(BaseRole::class,'role_id', 'id');
    }

    /**
     * 在缓存开启状态下缓存用户下的所有角色
     * @method cachedRoles
     *
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @author luffyzhao@vip.126.com
     */
    public function cachedRole()
    {
        $cacheKey = 'BaseAdmin:cachedRole' . $this->getKey();

        if(Cache::getStore() instanceof TaggableStore) {
            return Cache::tags('BaseAuth')->remember($cacheKey, Config::get('cache.ttl'), function () {
                return $this->roles()->first();
            });
        }
        else return $this->roles()->first();
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
        $role = $this->cachedRole();
        if($role && $role->super === 1){
            return true;
        }
        foreach ($role->cachedPermissions() as $perm) {
            if (str_is( $permission, $perm->name) ) {
                return true;
            }
        }

        return false;
    }
}
