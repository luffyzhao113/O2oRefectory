<?php
/**
 *  商家
 */


use Illuminate\Support\Facades\Route;

Route::get('/', 'ViewController@index');
/*接口*/
Route::prefix('api')->group(
    function () {

    }
);

/*商家后台管理系统*/
Route::prefix('admin')->namespace('Admin')->group(
    function () {
        Route::get('/', 'ViewController@admin');


        /*商家后台管理系统接口*/
        Route::prefix('api')->group(
            function () {
                Route::post('auth', 'AuthController@store')->name('login');
                Route::get('ueditor', 'UeditorController@index');
                Route::post('ueditor', 'UeditorController@uploader');

                Route::group(
                    ['middleware' => 'auth:seller'],
                    function () {
                        Route::get('auth', 'AuthController@index');
                        Route::put('auth/user', 'AuthController@user');
                        Route::delete('auth/lock', 'AuthController@lock');

                        Route::group(
                            [
                                'middleware' => 'auth:seller',
                            ],
                            function () {
                                Route::resource('role', 'RoleController')->except(['show'])->names(
                                    [
                                        'create' => 'role.store',
                                        'edit' => 'role.update',
                                    ]
                                );

                                Route::get('admin/lists', 'AdminController@lists')->name('admin.index');
                                Route::resource('admin', 'AdminController')->except(['show'])->names(
                                    [
                                        'create' => 'admin.store',
                                        'edit' => 'admin.update',
                                    ]
                                );

                                Route::resource('model', 'ModelController')->except(['show', 'create'])->names(
                                    [
                                        'edit' => 'model.update',
                                    ]
                                );


                                Route::get('goods/recycle', 'GoodsController@recycle')->name('goods.recycle');
                                Route::put('goods/{goods}/restore', 'GoodsController@restore')->name('goods.restore');
                                Route::resource('goods', 'GoodsController')->except(['show'])->names(
                                    [
                                        'create' => 'goods.store',
                                        'edit' => 'goods.update',
                                    ]
                                );

                                Route::resource('banner', 'BannerController')->except(['show', 'create'])->names(
                                    [
                                        'edit' => 'banner.update',
                                    ]
                                );
                            }
                        );
                    }
                );
            }
        );
    }
);