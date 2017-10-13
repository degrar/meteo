<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Support\Facades\App;

class MorillasCrudController extends CrudController
{
    public function __construct()
    {
        App::setLocale('es');
        parent::__construct();
    }
}