<?php

namespace Bradmin\Plugins\BrainorPay\Controllers;

use Bradmin\Controllers\BrAdminController;
use Bradmin\Section;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class BrainorPayController extends Controller
{
    private $pluginData = [
        'redirectUrl' => '/bradmin/pay/{sectionName}'
    ];

    public function showRouteRedirect(Section $section, $sectionName, Request $request)
    {
        $mainController = new BrAdminController;

        return $mainController->getDisplay($section, $sectionName, $this->pluginData, $request);
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
