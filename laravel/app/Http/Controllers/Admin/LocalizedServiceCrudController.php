<?php namespace App\Http\Controllers\Admin;

use Backpack\LangFileManager\app\Models\Language;

use App\Http\Requests\LocalizedServiceCrudRequest as StoreRequest;
use App\Http\Requests\LocalizedServiceCrudRequest as UpdateRequest;

class LocalizedServiceCrudController extends MorillasCrudController
{
    /**
     * Add columns.
     */
    protected function addColumns() {
        $this->crud->setColumns([
            [
                'label' => 'Idioma',
                'type' => 'select',
                'name' => 'language_id',
                'entity' => 'language',
                'attribute' => 'abbr',
                'model' => 'Backpack\LangFileManager\app\Models\Language'
            ],
            [
                'label' => 'Servicio',
                'type' => 'select',
                'name' => 'service_id',
                'entity' => 'service',
                'attribute' => 'name',
                'model' => 'App\Models\Content\Service'
            ],
            [
                'label' => 'Servicio Localizado',
                'name' => 'title'
            ]
        ]);
    }

    /**
     * Add filters.
     */
    protected function addFilters() {
        $this->crud->addFilter([
            'type' => 'select2',
            'name' => 'language',
            'label' => 'Idioma'
        ], function() {
            $languages = [];
            foreach(Language::all() as $lang) {
                $languages[$lang->id] = $lang->name;
            }
            return $languages;
        }, function($value) {
                $this->crud->addClause('where', 'language_id', $value);
            }
        );
    }

    /**
     * Add fields.
     */
    public function addFields() {
        $this->crud->addField([
            'label' => 'Servicios',
            'type' => 'select2',
            'name' => 'service_id',
            'entity' => 'service',
            'attribute' => 'name',
            'model' => 'App\Models\Content\Service'
        ]);
        $this->crud->addField([
            'label' => 'Idioma',
            'type' => 'select2',
            'name' => 'language_id',
            'entity' => 'language',
            'attribute' => 'abbr',
            'model' => 'Backpack\LangFileManager\app\Models\Language'

        ]);
        $this->crud->addField([
            'name' => 'title',
            'label' => "Titulo"
        ]);
        $this->crud->addField([
            'name' => 'content',
            'label' => "Contenido",
            'type' => 'wysiwyg'
        ]);
    }

    /**
     * LocalizedServiceCrudController setup.
     */
    public function setup() {
        $this->crud->setModel('App\Models\Content\LocalizedService');
        $this->crud->setRoute("admin/localize_services");
        $this->crud->setEntityNameStrings('service translation', 'service translations');

        $this->crud->addButtonFromView('top','add_service','add_service');
        $this->crud->removeButton('delete');
        $this->addFilters();
        $this->addColumns();
        $this->addFields();
    }

    /**
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }

    /**
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }
}