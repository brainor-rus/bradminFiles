<?php

// Редиректы /////////////////////////////////////////////////////////////////////////////

Route::post('/'.config('bradmin.admin_url').'/BRCommerce/{sectionName}', [
    'as'   => 'bradmin.BRCommerce.display-plugin',
    'uses' => 'Bradmin\Plugins\BRCommerce\Controllers\BRCommerceController@showRouteRedirect',
]);

Route::post('/'.config('bradmin.admin_url').'/BRCommerce/{sectionName}/create', [
    'as'   => 'bradmin.BRCommerce.create-plugin',
    'uses' => 'Bradmin\Plugins\BRCommerce\Controllers\BRCommerceController@createRouteRedirect',
]);

Route::post('/'.config('bradmin.admin_url').'/BRCommerce/{sectionName}/{id}/edit', [
    'as'   => 'bradmin.BRCommerce.edit-plugin',
    'uses' => 'Bradmin\Plugins\BRCommerce\Controllers\BRCommerceController@editRouteRedirect',
]);

Route::post('/'.config('bradmin.admin_url').'/BRCommerce/{sectionName}/{id}/delete', [
    'as'   => 'bradmin.BRCommerce.delete-action-plugin',
    'uses' => 'Bradmin\Plugins\BRCommerce\Controllers\BRCommerceController@deleteActionRouteRedirect',
]);