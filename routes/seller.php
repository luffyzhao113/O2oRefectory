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

                Route::group(
                    ['middleware' => 'auth:seller'],
                    function () {
                        Route::get('auth', 'AuthController@index');
                        Route::get('auth/permission', 'AuthController@permission');
                        Route::put('auth/user', 'AuthController@user');
                        Route::delete('auth/lock', 'AuthController@lock');

                        Route::group(
                            [
                                'middleware' => 'auth:seller'
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
                            }
                        );
                    }
                );
            }
        );
    }
);