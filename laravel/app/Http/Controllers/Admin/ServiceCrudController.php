<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests\ServiceCrudRequest as StoreRequest;
use App\Http\Requests\ServiceCrudRequest as UpdateRequest;

class ServiceCrudController extends MorillasCrudController
{
    /**
     * ServiceCrudController setup.
     */
    public function setup() {
        $this->crud->setModel('App\Models\Content\Service');
        $this->crud->setRoute("admin/services");
        $this->crud->setEntityNameStrings('servicio', 'servicios');

        $this->crud->enableReorder('name');
        $this->crud->allowAccess('reorder');

        $this->crud->addColumn([
            'name' => 'name',
            'label' => "Nombre"
        ]);

        $this->crud->addField([
            'name' => 'name',
            'label' => "Nombre"
        ]);

        $this->crud->addField([ // image
            'label' => "Imagen de fondo del servicio",
            'name' => "image",
            'type' => 'image',
            'upload' => true,
//            'crop' => true, // set to true to allow cropping, false to disable
//            'aspect_ratio' => 1.6, // ommit or set to 0 to allow any aspect ratio
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