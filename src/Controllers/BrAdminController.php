<?php

namespace Bradmin\Controllers;

use Bradmin\SectionBuilder\Form\FormAction\FormAction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

use Bradmin\Section;
use Bradmin\Navigation\NavigationManager;

class BrAdminController extends Controller
{

    public function getIndex()
    {
        return view('bradmin::spa');
    }

    public function getDashboard()
    {
        return response()->json([
                'html' => View::make('bradmin::dashboard')->render(),
                'meta' => [
                    'title' => 'Главная'
                ]
            ]
        );
    }

    public function getSidebarMenu(\Illuminate\Contracts\Foundation\Application  $app)
    {
        $navigation = NavigationManager::returnNavigation($app);

        return response()->json($navigation);
    }

    public function getDisplay(Section $section, $sectionName, $pluginData = null)
    {
        $display = $section->fireDisplay($sectionName);
        $sectionModelSettings = $section->getSectionSettings(studly_case($sectionName));

        $firedSection = $section->getSectionByName($sectionName);
        $results = $display->render($sectionModelSettings['model'] ?? config('bradmin.base_models_path') . studly_case(strtolower(str_singular($sectionName))), $firedSection, $pluginData);

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

    public function getCreate(Section $section, $sectionName, $pluginData = null)
    {
        $firedSection = $section->getSectionByName($sectionName);
        if(isset($firedSection)) {
            if ($firedSection->isCreatable()) {
                $display = $section->fireCreate(studly_case($sectionName));
                $sectionModelSettings = $section->getSectionSettings(studly_case($sectionName));

                $html = $display->render($sectionModelSettings['model'] ?? config('bradmin.base_models_path') . studly_case(strtolower(str_singular($sectionName))), $sectionName, $firedSection, null, $pluginData);
                $meta = [
                    'title' => $sectionModelSettings['title'] . '| Новая запись'
                ];

                return $this->render($html, '', $meta);
            }
            else{
                return $this->render("Создание в этой секции невозможно");
            }
        } else
        {
            return $this->render("Секция не найдена");
        }
    }


    public function getEdit(Section $section, $sectionName, $id, $pluginData = null)
    {
        $firedSection = $section->getSectionByName($sectionName);
        if(isset($firedSection)) {
            if ($firedSection->isEditable()) {
                $display = $section->fireEdit(studly_case($sectionName));
                $sectionModelSettings = $section->getSectionSettings(studly_case($sectionName));

                $html = $display->render($sectionModelSettings['model'] ?? config('bradmin.base_models_path') . studly_case(strtolower(str_singular($sectionName))), $sectionName, $firedSection, $id, $pluginData);
                $meta = [
                    'title' => $sectionModelSettings['title'] . '| Редактирование'
                ];

                return $this->render($html, '', $meta);
            }
            else{
                return $this->render("Редактирование этой секции невозможно.");
            }
        }
    }

    public function createAction(Section $section, $sectionName, Request $request)
    {
        $class = $section->getSectionByName($sectionName);
        $redirectUrl = $request->pluginData['deleteUrl'] ?? '/' . config('bradmin.admin_url') . '/' . $sectionName;
        if(!isset($class)) { abort(500); }
        if ($class->isEditable()) {
            $request->offsetUnset('_token');
            $request->offsetUnset('pluginData');
            $sectionModelSettings = $section->getSectionSettings(studly_case($sectionName));
            $modelPath = $sectionModelSettings['model'] ?? config('bradmin.base_models_path') . studly_case(strtolower(str_singular($sectionName)));

            $model = new $modelPath;
            $attrFields = Schema::getColumnListing($model->getTable());
            $relationFields = array_diff_key($request->all(), array_flip($attrFields));

            $model = $model::create($request->all());
            $model = $model->where('id', $model->id)
                ->when(isset($relationFields), function ($query) use ($relationFields) {
                    $query->with(array_keys($relationFields));
                })
                ->first();

            //        FormAction::save($model, $request);
            FormAction::saveBelongsToRelations($model, $request);
            FormAction::saveBelongsToManyRelations($model, $request);
            FormAction::saveHasOneRelations($model, $request);

            //        return redirect()->back();

            return response()->json([
                    'data' => [
                        'code' => 0,
                        'message' => 'Успешно',
                        'class' => 'success'
                    ],
                    'redirect' => [
                        'url' => $redirectUrl
                    ]
                ]
            );
        }
    }

    public function editAction(Section $section, $sectionName, Request $request, $id)
    {
        $class = $section->getSectionByName($sectionName);
        $redirectUrl = $request->pluginData['deleteUrl'] ?? '/' . config('bradmin.admin_url') . '/' . $sectionName;
        if(!isset($class)) { abort(500); }
        if ($class->isEditable()) {
            $request->offsetUnset('_token');
            $request->offsetUnset('pluginData');
            $sectionModelSettings = $section->getSectionSettings(studly_case($sectionName));
            $modelPath = $sectionModelSettings['model'] ?? config('bradmin.base_models_path') . studly_case(strtolower(str_singular($sectionName)));

            $model = new $modelPath;
            $attrFields = Schema::getColumnListing($model->getTable());
            $relationFields = array_diff_key($request->all(), array_flip($attrFields));

            $model = $model->where('id', $id)
                ->when(isset($relationFields), function ($query) use ($relationFields) {
                    $query->with(array_keys($relationFields));
                })
                ->first();

            FormAction::save($model, $request);
            FormAction::saveBelongsToRelations($model, $request);
            FormAction::saveBelongsToManyRelations($model, $request);
            FormAction::saveHasOneRelations($model, $request);

            //        $modelPath::where('id', $id)->update($request->all());

            return response()->json([
                    'data' => [
                        'code' => 0,
                        'message' => 'Успешно',
                        'class' => 'success'
                    ],
                    'redirect' => [
                        'url' => $redirectUrl
                    ]
                ]
            );
        }
    }

    public function deleteAction(Section $section, $sectionName, $id, Request $request)
    {
        $sectionModelSettings = $section->getSectionSettings($sectionName);
        $modelPath = $sectionModelSettings['model'] ?? config('bradmin.base_models_path') . studly_case(strtolower(str_singular($sectionName)));
        $model = new $modelPath;
        $class = $section->getSectionByName($sectionName);
        if(!isset($class)) { abort(500); }
        $redirectUrl = $request->pluginData['deleteUrl'] ?? '/'.config('bradmin.admin_url').'/'.$sectionName;
        if($class->isDeletable()){
            $model->where('id', $id)->delete();
            return response()->json([
                    'data' => [
                        'code'=>0,
                        'message'=>'Успешно',
                        'class'=>'success'
                    ],
                    'redirect' => [
                        'url' => $redirectUrl
                    ]
                ]
            );
        }
        else{
            return response()->json([
                    'data' => [
                        'code'=>500,
                        'message'=>'Ошибка',
                        'class'=>'error'
                    ],
                    'redirect' => [
                        'url' => $redirectUrl
                    ]
                ]
            );
        }
    }

    public function render($html, $pagination=null, $meta=null)
    {
        return response()->json([
                'html' => View::make('bradmin::content.general')->with(compact('html'))->render(),
                'data' => [
                    'pagination' => $pagination ?? '',
                    ],
                'meta' => $meta ?? ''
            ]
        );
    }

    public function getImage($path){
        return response()->file(base_path() . '/bradmin/images/' . $path);
    }

    public function postEdit()
    {

    }
}
