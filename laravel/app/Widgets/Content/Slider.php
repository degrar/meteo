<?php

namespace App\Widgets\Content;

use App\Models\Content\LocalizedSliderElement;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\App;

class Slider extends AbstractWidget
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
        static $slider_element = 0;
        $slider_element++;

        $sliders = LocalizedSliderElement::languageAbbr(App::getLocale())
                                         ->sliderCode($this->config['slider_code'])
                                         ->ordered()
                                         ->get();

        return view("widgets.content.slider", [
            'config' => $this->config,
            'widget_number' => $slider_element,
            'widget_name' => $this->config['slider_code'],
            'elements' => $sliders,
        ]);
    }
}