<?php
/**
 *  商家
 */

Route::get('/', 'ViewController@index');
/*接口*/
Route::prefix('api')->group(function () {

});

/*商家后台管理系统*/
Route::prefix('admin')->group(function () {
    Route::get('/', 'ViewController@admin');


    /*商家后台管理系统接口*/
    Route::prefix('api')->group(function () {

    });
});