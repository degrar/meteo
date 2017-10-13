<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class DashboardController
{
    public function index()
    {
        App::setLocale('es');
        return View::make('admin.dashboard');
    }
}