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
    private $pluginData = [
        'sectionPath' => 'Bradmin\Cms\Sections\\',
        'redirectUrl' => '/bradmin/cms/{sectionName}'
    ];

    public function __construct(\Illuminate\Contracts\Foundation\Application $app)
    {
        $this->app = $app;
    }

    public function showRouteRedirect(Section $section, $sectionName)
    {
        $mainController = new BrAdminController;
        return $mainController->getDisplay($section, $sectionName, $this->pluginData);
    }

    public function createRouteRedirect(Section $section, $sectionName)
    {
        $mainController = new BrAdminController;

        return $mainController->getCreate($section, $sectionName, $this->pluginData);
    }

    public function editRouteRedirect(Section $section, $sectionName, $id)
    {
        $mainController = new BrAdminController;

        return $mainController->getEdit($section, $sectionName, $id, $this->pluginData);
    }

    public function createActionRouteRedirect(Section $section, $sectionName, Request $request)
    {
        $mainController = new BrAdminController;

        return $mainController->createAction($section, $sectionName, $request);
    }

    public function editActionRouteRedirect(Section $section, $sectionName, $id, Request $request)
    {
        $mainController = new BrAdminController;

        return $mainController->editAction($section, $sectionName, $id, $request);
    }

    public function deleteActionRouteRedirect(Section $section, $sectionName, $id, Request $request)
    {
        $mainController = new BrAdminController;

        return $mainController->deleteAction($section, $sectionName, $id, $request);
    }
}
