<?php

namespace Bradmin\Cms\Controllers;

use Bradmin\Controllers\BrAdminController;
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

    public function getDisplay(Section $section, $sectionName)
    {
        $pluginData['sectionPath'] = 'Bradmin\Cms\Sections\\';

        $mainController = new BrAdminController;
        return $mainController->getDisplay($section, $sectionName, $pluginData);
    }
}
