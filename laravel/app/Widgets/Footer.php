<?php

namespace App\Widgets;

use App\Models\Content\LocalizedService;
use App\Models\Content\LocalizedTeamMember;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class Footer extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $language = App::getLocale();
        $team = LocalizedTeamMember::languageAbbr($language)->get();
        $services = LocalizedService::LanguageAbbr($language)->sorted()->get();
        return view("widgets.footer", [
            'config' => $this->config,
            'team' => $team,
            'services' => $services,
        ]);
    }
}