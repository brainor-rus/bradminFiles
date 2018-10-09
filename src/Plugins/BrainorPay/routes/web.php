<?php

Route::post('/'.config('bradmin.admin_url').'/pay/banks', [
    'as'   => 'bradmin.pay.banks.display',
    'uses' => 'Bradmin\Plugins\BrainorPay\Controllers\BrainorPayController@displayBanks',
]);

// Редиректы /////////////////////////////////////////////////////////////////////////////

Route::post('/'.config('bradmin.admin_url').'/pay/{sectionName}', [
    'as'   => 'bradmin.pay.banks.display',
    'uses' => 'Bradmin\Plugins\BrainorPay\Controllers\BrainorPayController@showRouteRedirect',
]);

Route::post('/'.config('bradmin.admin_url').'/pay/{sectionName}/create', [
    'as'   => 'bradmin.pay.banks.display',
    'uses' => 'Bradmin\Plugins\BrainorPay\Controllers\BrainorPayController@createRouteRedirect',
]);

Route::post('/'.config('bradmin.admin_url').'/pay/{sectionName}/{id}/edit', [
    'as'   => 'bradmin.pay.banks.display',
    'uses' => 'Bradmin\Plugins\BrainorPay\Controllers\BrainorPayController@editRouteRedirect',
]);