<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class LocalizedSliderElement extends Model
{
    use CrudTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'localized_slider_elements';

    /**
     * Fillable items.
     *
     * @var array
     */
    protected $fillable = ['slider_element_id', 'language_id', 'title', 'subtitle'];

    /**
     * Get the localized slider of this element
     */
    public function slider_element()
    {
        return $this->belongsTo('App\Models\Content\SliderElement');
    }

    /**
     * Get the content that belongs to this localized content
     */
    public function language()
    {
        return $this->belongsTo('Backpack\LangFileManager\app\Models\Language');
    }

    /**
     * Return slider image assigned to this SliderElement
     *
     * @return string
     */
    public function getImageAttribute()
    {
        return $this->slider_element->image;
    }

    /**
     * Return slider image assigned to this SliderElement
     *
     * @return string
     */
    public function getCodeAttribute()
    {
        return $this->slider_element->code;
    }

    /**
     * scope to filter by a given $language
     */
    public function scopeLanguageAbbr($query, $language) {
        return $query->join('languages','languages.id','=','language_id')
                     ->where('languages.abbr', $language);
    }

    /**
     * scope to filter by a given $slider_code
     */
    public function scopeSliderCode($query, $slider_code) {
        return $query->join('slider_elements','slider_elements.id','=','slider_element_id')
                     ->join('sliders','sliders.id','=','slider_elements.slider_id')
                     ->where('sliders.code', $slider_code);
    }

    /**
     * scope to order the results
     */
    public function scopeOrdered($query) {
        return $query->orderBy('lft');
    }

    /**
     * LocalizedSliderElement Model boot function.
     */
    protected static function boot()
    {
        parent::boot();
    }
}
