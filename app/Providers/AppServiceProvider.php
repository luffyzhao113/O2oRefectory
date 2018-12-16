<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Validator as BaseValidator;
use App\Validation\Validator;
use Illuminate\Contracts\Translation\Translator;
use App\Repositories\Modules\BaseAdmin\Provider AS BaseAdmin;
use App\Repositories\Modules\BasePermission\Provider AS BasePermission;
use App\Repositories\Modules\BaseRole\Provider AS BaseRole;
use App\Repositories\Modules\Notification\Provider as Notification;
use App\Repositories\Modules\Seller\Provider as Seller;
use App\Repositories\Modules\SellerAdmin\Provider as SellerAdmin;
use App\Repositories\Modules\SellerPermission\Provider as SellerPermission;
use App\Repositories\Modules\SellerRole\Provider as SellerRole;
use App\Repositories\Modules\BaseCategory\Provider as BaseCategory;
use App\Repositories\Modules\BaseAttribute\Provider as BaseAttribute;
use App\Repositories\Modules\SellerModel\Provider as SellerModel;
use App\Repositories\Modules\SellerGoods\Provider as SellerGoods;
use App\Repositories\Modules\SellerBanner\Provider as SellerBanner;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        BaseValidator::resolver(function(Translator $translator, array $data, array $rules,
            array $messages = [], array $customAttributes = [])
        {
            return new Validator($translator, $data, $rules, $messages, $customAttributes);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(Notification::class);
        $this->app->register(BaseAdmin::class);
        $this->app->register(BasePermission::class);
        $this->app->register(BaseRole::class);
        $this->app->register(Seller::class);
        $this->app->register(SellerAdmin::class);
        $this->app->register(SellerPermission::class);
        $this->app->register(SellerRole::class);
        $this->app->register(BaseCategory::class);
        $this->app->register(BaseAttribute::class);
        $this->app->register(SellerModel::class);
        $this->app->register(SellerGoods::class);
        $this->app->register(SellerBanner::class);
    }
}
