<?php namespace App\Http\Controllers\Admin;

use Backpack\LangFileManager\app\Models\Language;
use App\Models\Content\Section;

use App\Http\Requests\LocalizedSectionCrudRequest as StoreRequest;
use App\Http\Requests\LocalizedSectionCrudRequest as UpdateRequest;

class LocalizedSectionCrudController extends MorillasCrudController
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
                'label' => 'Sección',
                'type' => 'select',
                'name' => 'section_id',
                'entity' => 'section',
                'attribute' => 'name',
                'model' => 'App\Models\Content\Section'
            ],
            [
                'label' => 'Sección Localizada',
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
        $this->crud->addFilter([
            'type' => 'select2',
            'name' => 'section',
            'label' => 'Sección'
        ], function() {
            $sections = [];
            foreach(Section::all() as $section) {
                $sections[$section->id] = $section->name;
            }
            return $sections;
        }, function($value) {
            $this->crud->addClause('where', 'section_id', $value);
        }
        );
    }

    /**
     * Add fields.
     */
    public function addFields() {
        $this->crud->addField([
            'label' => 'Translate for Section',
            'type' => 'infofield',
            'name' => 'section_name'
        ]);
        $this->crud->addField([
            'label' => 'Language',
            'type' => 'infofield',
            'name' => 'language_abbr'
        ]);
        $this->crud->addField([
            'name' => 'title',
            'label' => "Title"
        ]);
        $this->crud->addField([
            'name' => 'content',
            'label' => "Content",
            'type' => 'wysiwyg'
        ]);
    }

    /**
     * LocalizedSectionCrudController setup.
     */
    public function setup() {
        $this->crud->setModel('App\Models\Content\LocalizedSection');
        $this->crud->setRoute("admin/localize_sections");
        $this->crud->setEntityNameStrings('sección', 'secciones');

        $this->crud->removeButton('delete');
        $this->crud->removeButton('create');

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