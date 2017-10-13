<?php

namespace App\Traits;

use Backpack\CRUD\app\Http\Controllers\CrudFeatures\Reorder;

trait ImageReorderTrait {
    use Reorder;

    /**
     *  Reorder the items in the database using the Nested Set pattern.
     *
     *	Database columns needed: id, parent_id, lft, rgt, depth, name/title
     *
     *  @return Response
     */
    public function reorder()
    {
        $this->crud->hasAccessOrFail('reorder');
        if (! $this->crud->isReorderEnabled()) {
            abort(403, 'Reorder is disabled.');
        }
        // get all results for that entity
        $this->data['entries'] = $this->crud->getEntries();
        $this->data['crud'] = $this->crud;
        $this->data['title'] = trans('backpack::crud.reorder').' '.$this->crud->entity_name;
        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view('crud::reorder_img', $this->data);
    }
}