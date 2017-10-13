<?php
namespace App\Observers\Content;

use App\Models\Content\LocalizedSliderElement;
use Backpack\LangFileManager\app\Models\Language;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SliderElementObserver
{
    /**
     * deleting observer on SliderElement model.
     *
     * @param \App\Models\Content\SliderElement $slider_element
     */
    public function deleting($slider_element)
    {
        DB::transaction(function () use ($slider_element) {
            // Cascade delete of all localized services related with this service
            $slider_element->localized_slider_elements->each(function ($localized_slider_element) {
                $localized_slider_element->delete();
            });
        });
    }

    /**
     * created observer on SliderElement model.
     *
     * @param \App\Models\Content\SliderElement $slider_element
     */
    public function created($slider_element) {
        Language::all()->each(function($language) use ($slider_element) {
            DB::transaction(function () use ($slider_element, $language) {
                LocalizedSliderElement::create([
                    'language_id' => $language->id,
                    'slider_element_id' => $slider_element->id,
                    'title' => $slider_element->slider->code,
                ]);
            });
        });
    }

    /**
     * updated observer on SliderElement model.
     *
     * @param \App\Models\Content\SliderElement $slider_element
     */
    public function updating($slider_element) {
        $original = $slider_element->getOriginal();
        if($original['image'] !== '' && $original['image'] !== $slider_element->image) {
            Storage::disk("sliders")->delete(basename($original['image']));
        }
    }
}