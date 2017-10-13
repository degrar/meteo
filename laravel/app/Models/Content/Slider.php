<?php

namespace App\Models\Content;

use App\Observers\Content\SliderObserver;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Slider extends Model
{
    use CrudTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sliders';

    /**
     * Fillable items.
     *
     * @var array
     */
    protected $fillable = ['code'];

    /**
     * Get the localized contents of a service.
     */
    public function slider_elements()
    {
        return $this->hasMany('App\Models\Content\SliderElement');
    }

    /**
     * Slider Model boot function.
     */
    protected static function boot()
    {
        parent::boot();

        Slider::observe(new SliderObserver);
    }
}
