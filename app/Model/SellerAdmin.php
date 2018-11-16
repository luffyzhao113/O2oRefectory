<?php

namespace App\Model;

use App\Observers\Model\SellerAuthObservers;
use App\Plugins\Ueditor\Uploader;
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

    protected static function boot()
    {
        parent::boot();

        static::observe(SellerAuthObservers::class);
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

    /**
     * @param $value
     */
    protected function setPhotoAttribute($value){
        if(Uploader::isBase64($value)){
            $config = array(
                "pathFormat" => str_replace("{domain}", $this->getAttribute('id'), config('ueditor.scrawlPathFormat')),
                "maxSize" => config('ueditor.scrawlMaxSize'),
                "allowFiles" => config('ueditor.scrawlAllowFiles'),
                "oriName" => "scrawl.png",
            );
            $up = new Uploader(Uploader::getBase64Content($value), $config, 'base64');
            $this->attributes['photo'] = $up->getFileInfo()['url'];
        }
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
                return Cache::tags(['SellerAuth', 'SellerAuth:' . $this->getKey()])->remember(
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
                return Cache::tags(['SellerAuth', 'SellerAuth:' . $this->getKey()])->remember(
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
