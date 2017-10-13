<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Observers\Content\SectionObserver;

class Section extends Model
{
    use CrudTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sections';

    /**
     * Fillable items.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get the localized contents of a section.
     */
    public function localized_sections()
    {
        return $this->hasMany('App\Models\Content\LocalizedSection');
    }

    /**
     * Service Model boot function.
     */
    protected static function boot()
    {
        parent::boot();

        Section::observe(new SectionObserver);
    }
}
