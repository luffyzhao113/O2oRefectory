<?php
/**
 *  商家
 */

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
                    }
                );
            }
        );
    }
);