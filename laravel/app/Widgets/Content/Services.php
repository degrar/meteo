<?php

namespace App\Widgets\Content;

use Arrilot\Widgets\AbstractWidget;
use App\Models\Content\LocalizedService;
use App\Models\Content\Service;
use App\Models\Content\LocalizedTeamMember;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;


class Services extends AbstractWidget
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
        $services = LocalizedService::LanguageAbbr($language)->sorted()->get();

        $json_services_img = [];
        $json_services_content = [];
        foreach ($services as $key => $service) {
            $json_services_img['img_'.$service->id] = $service->image;
            $json_services_content['id_'.$service->id] = $service->content;
        }

        return view("widgets.content.services", [
            'config' => $this->config,
            'services' =>  $services,
            'json_services_content'  => json_encode($json_services_content),
            'json_services_img'  => json_encode($json_services_img),
        ]);
    }
}