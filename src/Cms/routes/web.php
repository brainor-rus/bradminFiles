<?php

Route::post('/'.config('bradmin.admin_url').'/cms/{section}', [
    'as'   => 'bradmin.cms.pages.display',
    'uses' => 'Bradmin\Cms\Controllers\CmsController@getDisplay',
]);

//Route::post('/'.config('bradmin.admin_url').'/cms/pages', [
//    'as'   => 'bradmin.cms.pages.display',
//    'uses' => 'Bradmin\Cms\Controllers\CmsController@displayPages',
//]);
//Route::post('/'.config('bradmin.admin_url').'/cms/posts', [
//    'as'   => 'bradmin.cms.pages.display',
//    'uses' => 'Bradmin\Cms\Controllers\CmsController@displayPages',
//]);
