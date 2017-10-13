<?php
namespace App\Observers\Content;

use App\Models\Content\SliderElement;
use Illuminate\Support\Facades\DB;

class SliderObserver
{
    /**
     * deleting observer on Slider model.
     *
     * @param \App\Models\Content\Slider $slider
     */
    public function deleting($slider)
    {
        DB::transaction(function () use ($slider) {
            // Cascade delete of all localized services related with this service
            $slider->slider_elements->each(function ($slider_element) {
                $slider_element->delete();
            });
        });
    }

    /**
     * created observer on Slider model.
     *
     * @param \App\Models\Content\Slider $slider
     */
    public function created($slider) {
        // ...
    }
}