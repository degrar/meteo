<?php namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\LangFileManager\app\Models\Language;

use App\Http\Requests\LocalizedSliderElementCrudRequest as StoreRequest;
use App\Http\Requests\LocalizedSliderElementCrudRequest as UpdateRequest;

class LocalizedSliderElementCrudController extends MorillasCrudController
{
    /**
     * Add columns.
     */
    protected function addColumns() {
        $this->crud->setColumns([
            [
                'label' => 'Language',
                'type' => 'select',
                'name' => 'language_id',
                'entity' => 'language',
                'attribute' => 'abbr',
                'model' => 'Backpack\LangFileManager\app\Models\Language'
            ],
            [
                'type' => 'image',
                'label' => "Image",
            ],
            [
                'label' => 'Slider Title',
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
            'label' => 'Language'
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
            'label' => 'Slider Image',
            'type' => 'infoimagefield',
            'name' => 'slider_admin_img'
        ]);
        $this->crud->addField([
            'name' => 'title',
            'label' => "Title",
        ]);
        $this->crud->addField([
            'name' => 'subtitle',
            'label' => "Subtitle",
        ]);
    }

    /**
     * LocalizedServiceCrudController setup.
     */
    public function setup() {
        $this->crud->setModel('App\Models\Content\LocalizedSliderElement');
        $this->crud->setRoute("admin/localize_sliders");
        $this->crud->setEntityNameStrings('slider translation', 'service translations');

        $this->crud->addButtonFromView('top','add_slider','add_slider');
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