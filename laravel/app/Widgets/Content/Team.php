<?php

namespace App\Widgets\Content;

use App\Models\Content\LocalizedSection;
use App\Models\Content\LocalizedTeamMember;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\App;

class Team extends AbstractWidget
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
        $team = LocalizedSection::languageAbbr(App::getLocale())
            ->sectionName('Team')
            ->first();

        $team_members = LocalizedTeamMember::languageAbbr(App::getLocale())->get();

        $json_injected = [];
        foreach($team_members as $team_member) {
            $json_injected[$team_member->team_member->id] = $team_member->content;
        }

        return view("widgets.content.team", [
            'config' => $this->config,
            'team_general_content' => $team,
            'team_members' => $team_members,
            'json_injected' => json_encode($json_injected),
        ]);
    }
}