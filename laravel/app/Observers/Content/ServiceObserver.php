<?php
namespace App\Observers\Content;

use Backpack\LangFileManager\app\Models\Language;
use App\Models\Content\LocalizedService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceObserver
{
    /**
     * deleting observer on Service model.
     *
     * @param \App\Models\Content\Service $service
     */
    public function deleting($service)
    {
        DB::transaction(function () use ($service) {
            // Cascade delete of all localized services related with this service
            $service->localized_services->each(function ($localized_service) {
                $localized_service->delete();
            });
        });
    }

    /**
     * created observer on Service model.
     *
     * @param \App\Models\Content\Service $service
     */
    public function created($service) {
        Language::all()->each(function($language) use ($service) {
            DB::transaction(function () use ($service, $language) {
                LocalizedService::create([
                    'title' => $service->name,
                    'language_id' => $language->id,
                    'service_id' => $service->id
                ]);
            });
        });
    }

    /**
     * updated observer on TeamMember model.
     *
     * @param \App\Models\Content\Service $service
     */
    public function updating($service) {
        $original = $service->getOriginal();
        if($original['image'] !== '') {
            Storage::disk("services")->delete(basename($original['image']));
        }
    }
}