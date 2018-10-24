<?php

// Редиректы /////////////////////////////////////////////////////////////////////////////

Route::post('/'.config('bradmin.admin_url').'/cms/{section}', [
    'as'   => 'bradmin.cms.pages.display',
    'uses' => 'Bradmin\Cms\Controllers\CmsController@showRouteRedirect',
]);

Route::post('/'.config('bradmin.admin_url').'/cms/{sectionName}', [
    'as'   => 'bradmin.cms.banks.display-plugin',
    'uses' => 'Bradmin\Cms\Controllers\CmsController@showRouteRedirect',
]);

Route::post('/'.config('bradmin.admin_url').'/cms/{sectionName}/create', [
    'as'   => 'bradmin.cms.banks.create-plugin',
    'uses' => 'Bradmin\Cms\Controllers\CmsController@createRouteRedirect',
]);

Route::post('/'.config('bradmin.admin_url').'/cms/{sectionName}/{id}/edit', [
    'as'   => 'bradmin.cms.banks.edit-plugin',
    'uses' => 'Bradmin\Cms\Controllers\CmsController@editRouteRedirect',
]);

Route::post('/'.config('bradmin.admin_url').'/cms/{sectionName}/{id}/create-action', [
    'as'   => 'bradmin.cms.banks.create-action-plugin',
    'uses' => 'Bradmin\Cms\Controllers\CmsController@createActionRouteRedirect',
]);

Route::post('/'.config('bradmin.admin_url').'/cms/{sectionName}/{id}/edit-action', [
    'as'   => 'bradmin.cms.banks.edit-action-plugin',
    'uses' => 'Bradmin\Cms\Controllers\CmsController@editActionRouteRedirect',
]);

Route::post('/'.config('bradmin.admin_url').'/cms/{sectionName}/{id}/delete', [
    'as'   => 'bradmin.cms.banks.delete-action-plugin',
    'uses' => 'Bradmin\Cms\Controllers\CmsController@deleteActionRouteRedirect',
]);