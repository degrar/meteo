<?php namespace App\Http\Controllers\Admin;

use Backpack\LangFileManager\app\Models\Language;
use App\Models\Content\TeamMember;

use App\Http\Requests\LocalizedTeamMemberCrudRequest as StoreRequest;
use App\Http\Requests\LocalizedTeamMemberCrudRequest as UpdateRequest;

class LocalizedTeamMemberCrudController extends MorillasCrudController
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
                'label' => 'Nombre',
                'name' => 'team_member_name'
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
            'name' => 'team_member',
            'label' => 'Nombre'
        ], function() {
            $team_members = [];
            foreach(TeamMember::all() as $team_member) {
                $team_members[$team_member->id] = $team_member->name;
            }
            return $team_members;
        }, function($value) {
            $this->crud->addClause('where', 'team_member_id', $value);
        }
        );
    }

    /**
     * Add fields.
     */
    public function addFields() {
        $this->crud->addField([
            'label' => 'Nombre',
            'type' => 'infofield',
            'name' => 'team_member_name'
        ]);
        $this->crud->addField([
            'label' => 'Idioma',
            'type' => 'infofield',
            'name' => 'language_abbr'
        ]);
        $this->crud->addField([
            'name' => 'short_description',
            'label' => "Short Description",
            'type' => 'wysiwyg'
        ]);
        $this->crud->addField([
            'name' => 'content',
            'label' => "CV",
            'type' => 'wysiwyg'
        ]);
    }

    /**
     * LocalizedTeamMemberCrudController setup.
     */
    public function setup() {
        $this->crud->setModel('App\Models\Content\LocalizedTeamMember');
        $this->crud->setRoute("admin/team_members");
        $this->crud->setEntityNameStrings('localizar CV del equipo', 'localizar CV del equipo');

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