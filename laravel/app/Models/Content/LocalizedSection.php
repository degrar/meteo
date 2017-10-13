<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class LocalizedSection extends Model
{
    use CrudTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'localized_sections';

    /**
     * Fillable items.
     *
     * @var array
     */
    protected $fillable = ['section_id', 'language_id', 'title', 'content'];

    /**
     * Get the content that belongs to this localized content
     */
    public function section()
    {
        return $this->belongsTo('App\Models\Content\Section');
    }

    /**
     * Get the content that belongs to this localized content
     */
    public function language()
    {
        return $this->belongsTo('Backpack\LangFileManager\app\Models\Language');
    }

    /**
     * Return language abbr assigned to this Section
     *
     * @return string
     */
    public function getLanguageAbbrAttribute()
    {
        return $this->language->abbr;
    }

    /**
     * Return section name assigned to this Section
     *
     * @return string
     */
    public function getSectionNameAttribute()
    {
        return $this->section->name;
    }

    /**
     * scope to filter by a given $language
     */
    public function scopeLanguageAbbr($query, $language) {
        return $query->join('languages','languages.id','=','language_id')
                     ->where('languages.abbr', $language);
    }

    /**
     * scope to filter by a given $section
     */
    public function scopeSectionName($query, $section) {
        return $query->join('sections','sections.id','=','section_id')
                     ->where('sections.name', $section);
    }
}
