<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests\TeamMemberCrudRequest as StoreRequest;
use App\Http\Requests\TeamMemberCrudRequest as UpdateRequest;

class TeamMemberCrudController extends MorillasCrudController
{
    /**
     * TeamMemberCrudController setup.
     */
    public function setup() {
        $this->crud->setModel('App\Models\Content\TeamMember');
        $this->crud->setRoute("admin/team_image");
        $this->crud->setEntityNameStrings('fotos del equipo', 'fotos del equipo');

        $this->crud->removeButton('delete');
        $this->crud->removeButton('create');

        $this->crud->addColumn([
            'name' => 'name',
            'label' => "Nombre"
        ]);

        $this->crud->addField([
            'label' => 'Nombre',
            'type' => 'infofield',
            'name' => 'name'
        ]);

        $this->crud->addField([
            'label' => 'URL LinkedIn',
            'type' => 'text',
            'name' => 'linkedin_uri'
        ]);

        $this->crud->addField([ // image
            'label' => "Foto del miembro del equipo",
            'name' => "image",
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
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