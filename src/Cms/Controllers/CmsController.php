<?php

namespace Bradmin\Cms\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

use Bradmin\Section;
use Bradmin\Navigation\NavigationManager;

class CmsController extends Controller
{
    public function __construct(\Illuminate\Contracts\Foundation\Application $app)
    {
        $this->app = $app;
    }

    public function displayPages()
    {
        return response()->json([
                'html' => View::make('cms::pages')->render(),
                'meta' => [
                    'title' => 'Страницы'
                ]
            ]
        );
    }
}
