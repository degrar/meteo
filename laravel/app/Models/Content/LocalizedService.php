<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class LocalizedService extends Model
{
    use CrudTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'localized_services';

    /**
     * Fillable items.
     *
     * @var array
     */
    protected $fillable = ['service_id', 'language_id', 'title', 'content'];

    /**
     * Get the content that belongs to this localized content
     */
    public function service()
    {
        return $this->belongsTo('App\Models\Content\Service');
    }

    /**
     * Get the content that belongs to this localized content
     */
    public function language()
    {
        return $this->belongsTo('Backpack\LangFileManager\app\Models\Language');
    }

    /**
     * scope to filter by a given $language
     */
    public function scopeLanguageAbbr($query, $language) {
        return $query->join('languages','languages.id','=','language_id')
                     ->where('languages.abbr', $language);
    }

    /**
     * scope to filter by a given $language
     */
    public function scopeSorted($query){
        return $query->join('services', 'services.id', '=', 'service_id')
                     ->orderBy('services.lft','asc');
    }


}
