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

    public function getDisplay(Section $section, $sectionName, $pluginData = null)
    {

        // todo вызывать через экземпляр BrAdminController

        $display = $section->fireDisplay($sectionName, [], 'Bradmin\Cms\Sections\\');
        $sectionModelSettings = $section->getSectionSettings(studly_case($sectionName), 'Bradmin\Cms\Sections\\');


        $firedSection = $section->getSectionByName($sectionName, 'Bradmin\Cms\Sections\\');
        $results = $display->render($sectionModelSettings['model'], $firedSection, $pluginData);

        $html = $results['view'];
        $pagination = [
            'total' => $results['data']->total(),
            'per_page' => $results['data']->perPage(),
            'current_page' => $results['data']->currentPage(),
            'last_page' => $results['data']->lastPage(),
            'from' => $results['data']->firstItem(),
            'to' => $results['data']->lastItem()
        ];
        $meta = [
            'title' => $sectionModelSettings['title']
        ];

        return $this->render($html,$pagination,$meta);
    }
}
