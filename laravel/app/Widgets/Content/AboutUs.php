<?php

namespace App\Widgets\Content;

use App\Models\Content\LocalizedSection;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\App;

class AboutUs extends AbstractWidget
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
        $about_us = LocalizedSection::languageAbbr(App::getLocale())
            ->sectionName('About Us')
            ->first();

        return view("widgets.content.about_us", [
            'config' => $this->config,
            'title' => $about_us->title,
            'content' => $about_us->content,
            'subtitle' => "Implantis 2001-".date('Y'),
        ]);
    }
}