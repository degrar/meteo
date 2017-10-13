<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class LocalizedTeamMember extends Model
{
    use CrudTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'localized_team_members';

    /**
     * Fillable items.
     *
     * @var array
     */
    protected $fillable = ['team_member_id', 'language_id', 'short_description', 'content'];

    /**
     * Get the content that belongs to this localized content
     */
    public function team_member()
    {
        return $this->belongsTo('App\Models\Content\TeamMember');
    }

    /**
     * Get the content that belongs to this localized content
     */
    public function language()
    {
        return $this->belongsTo('Backpack\LangFileManager\app\Models\Language');
    }

    /**
     * Return language abbr assigned to this Team Member
     *
     * @return string
     */
    public function getLanguageAbbrAttribute()
    {
        return $this->language->abbr;
    }

    /**
     * Return language name assigned to this Team Member
     *
     * @return string
     */
    public function getTeamMemberNameAttribute()
    {
        return $this->team_member->name;
    }

    /**
     * scope to filter by a given $language
     */
    public function scopeLanguageAbbr($query, $language) {
        return $query->join('languages','languages.id','=','language_id')
            ->where('languages.abbr', $language);
    }
}
