<?php namespace App\Http\Controllers\Admin;

use App\Models\Content\Slider;
use App\Traits\ImageReorderTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;

use App\Http\Requests\SliderElementCrudRequest as StoreRequest;
use App\Http\Requests\SliderElementCrudRequest as UpdateRequest;

class SliderElementCrudController extends MorillasCrudController
{
    use ImageReorderTrait;

    /**
     * Add filters.
     */
    protected function addFilters() {
        $this->crud->addFilter([
            'type' => 'select2',
            'name' => 'code',
            'label' => 'Slider'
        ], function() {
            $sliders = [];
            foreach(Slider::all() as $slider) {
                $sliders[$slider->id] = $slider->code;
            }
            return $sliders;
        }, function($value) {
            $this->crud->addClause('where', 'slider_id', $value);
        }
        );
    }

    /**
     * SliderElementCrudController setup.
     */
    public function setup() {
        $this->crud->setModel('App\Models\Content\SliderElement');
        $this->crud->setRoute("admin/sliders");
        $this->crud->setEntityNameStrings('slider', 'sliders');

        $this->crud->enableReorder('slider_admin_img');
        $this->crud->allowAccess('reorder');

        $this->addFilters();

        $this->crud->addColumn([
            'type' => 'image',
            'label' => "Image",
        ]);

        $this->crud->addField([
            'label' => 'Slider',
            'type' => 'select2',
            'name' => 'slider_id',
            'entity' => 'slider',
            'attribute' => 'code',
            'model' => 'App\Models\Content\Slider'
        ]);

        $this->crud->addField([ // image
            'label' => "Slider image",
            'name' => "image",
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1.6, // ommit or set to 0 to allow any aspect ratio
        ]);
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