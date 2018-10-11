<?php
/**
 * Base系统api
 * User: luffyzhao
 * Date: 2018/6/18
 * Time: 20:54
 */

Route::get('/', 'ViewController@index');

Route::post('auth', 'AuthController@store')->name('login');

Route::group(
    ['middleware' => 'auth'],
    function () {
        Route::get('auth', 'AuthController@index');
        Route::put('auth/user', 'AuthController@user')->name('auth.user');
        Route::delete('auth/lock', 'AuthController@lock')->name('auth.lock');
        // 登录用户相关消息
        Route::get('message/not-read', 'MessageController@notRead');
        Route::apiResource('message', 'MessageController')->except(['show', 'store', 'destroy']);

        Route::get('validator/seller', 'ValidatorController@seller');
        Route::get('validator/seller-email', 'ValidatorController@sellerEmail');

        Route::group(
            ['middleware' => ['entrust:base']],
            function () {
                // 权限&菜单
                Route::resource('permission', 'PermissionController')->except(['show'])->names(
                    [
                        'create' => 'permission.store',
                        'edit' => 'permission.update',
                    ]
                );;
                // 角色管理
                Route::resource('role', 'RoleController')->except(['show'])->names(
                    [
                        'create' => 'role.store',
                        'edit' => 'role.update',
                    ]
                );
                // 用户管理
                Route::get('admin/lists', 'AdminController@lists')->name('admin.index');
                Route::resource('admin', 'AdminController')->except(['show'])->names(
                    [
                        'create' => 'admin.store',
                        'edit' => 'admin.update',
                    ]
                );
                // 店铺管理
                Route::resource('seller', 'SellerController')->names(
                    [
                        'edit' => 'admin.sellers.update',
                    ]
                );

                Route::resource('seller_perms', 'Seller\PermissionController')->except(['show'])->names(
                    [
                        'create' => 'seller_perms.store',
                        'edit' => 'seller_perms.update',
                    ]
                );

                Route::resource('category', 'CategoryController')->except(['show'])->names(
                    [
                        'create' => 'category.store',
                        'edit' => 'category.update',
                    ]
                );

                Route::resource('attribute', 'AttributeController')->except(['show'])->names(
                    [
                        'create' => 'attribute.store',
                        'edit' => 'attribute.update',
                    ]
                );

            }
        );

    }
);


