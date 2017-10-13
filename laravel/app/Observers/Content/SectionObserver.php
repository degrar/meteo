<?php
namespace App\Observers\Content;

use Backpack\LangFileManager\app\Models\Language;
use App\Models\Content\LocalizedSection;
use Illuminate\Support\Facades\DB;

class SectionObserver
{
    /**
     * deleting observer on Section model.
     *
     * @param \App\Models\Content\Section $section
     */
    public function deleting($section)
    {
        DB::transaction(function () use ($section) {
            // Cascade delete of all localized services related with this service
            $section->localized_sections->each(function ($localized_section) {
                $localized_section->delete();
            });
        });
    }

    /**
     * created observer on Section model.
     *
     * @param \App\Models\Content\Section $section
     */
    public function created($section) {
        Language::all()->each(function($language) use ($section) {
            DB::transaction(function () use ($section, $language) {
                LocalizedSection::create([
                    'title' => $section->name,
                    'language_id' => $language->id,
                    'section_id' => $section->id
                ]);
            });
        });
    }
}