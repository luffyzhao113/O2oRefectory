<?php
/**
 *  商家
 */

Route::get('/', 'HomeController@seller');

Route::prefix('api')->group(
    function () {
//        Route::get('/', '');
    }
);;
