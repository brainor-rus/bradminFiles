<?php

namespace Bradmin\Plugins\BrainorPay\Controllers;

use Bradmin\Controllers\BrAdminController;
use Bradmin\Section;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class BrainorPayController extends Controller
{
    public function showRouteRedirect(Section $section, $sectionName)
    {
        $mainController = new BrAdminController;

        return $mainController->getDisplay($section, $sectionName);
    }

    public function createRouteRedirect(Section $section, $sectionName)
    {
        $mainController = new BrAdminController;

        return $mainController->getCreate($section, $sectionName);
    }

    public function editRouteRedirect(Section $section, $sectionName, $id)
    {
        $mainController = new BrAdminController;

        return $mainController->getEdit($section, $sectionName, $id);
    }
}
