<?php
/**
 *  商家
 */

Route::domain('{domain}.o2orefectory.test')->group(function () {
//    Route::get('/', \App\Http\Controllers\Web\HomeController::class . '@seller');

    Route::prefix('api')->group(function () {
//        Route::get('/', '');
    });
});