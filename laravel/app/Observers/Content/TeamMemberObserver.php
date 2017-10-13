<?php
namespace App\Observers\Content;

use Backpack\LangFileManager\app\Models\Language;
use App\Models\Content\LocalizedTeamMember;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TeamMemberObserver
{
    /**
     * deleting observer on TeamMember model.
     *
     * @param \App\Models\Content\TeamMember $team_member
     */
    public function deleting($team_member)
    {
        DB::transaction(function () use ($team_member) {
            // Cascade delete of all localized team members related with this team member
            $team_member->localized_team_member->each(function ($localized_team_member) {
                $localized_team_member->delete();
            });
        });
    }

    /**
     * created observer on TeamMember model.
     *
     * @param \App\Models\Content\TeamMember $team_member
     */
    public function created($team_member) {
        Language::all()->each(function($language) use ($team_member) {
            DB::transaction(function () use ($team_member, $language) {
                LocalizedTeamMember::create([
                    'language_id' => $language->id,
                    'team_member_id' => $team_member->id
                ]);
            });
        });
    }

    /**
     * updated observer on TeamMember model.
     *
     * @param \App\Models\Content\TeamMember $team_member
     */
    public function updating($team_member) {
        $original = $team_member->getOriginal();
        if($original['image'] !== '' && $team_member->image !== $original['image']) {
            Storage::disk("photos")->delete(basename($original['image']));
        }
    }
}