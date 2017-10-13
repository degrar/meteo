<?php

namespace App\Models\Content;

use App\Observers\Content\SliderElementObserver;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SliderElement extends Model
{
    use CrudTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'slider_elements';

    /**
     * Fillable items.
     *
     * @var array
     */
    protected $fillable = ['slider_id', 'image'];

    /**
     * Get the localized contents of a service.
     */
    public function localized_slider_elements()
    {
        return $this->hasMany('App\Models\Content\LocalizedSliderElement');
    }

    /**
     * Get the slider of this element
     */
    public function slider()
    {
        return $this->belongsTo('App\Models\Content\Slider');
    }

    /**
     * Return slider code assigned to this SliderElement
     *
     * @return string
     */
    public function getSliderCodeAttribute()
    {
        return $this->slider->code;
    }

    /**
     * Return code of this slider
     *
     * @return string
     */
    public function getCodeAttribute()
    {
        return $this->slider->code;
    }

    /**
     * Mutator to store the image
     */
    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $disk = "sliders";
        $destination_path = "/uploads/sliders";

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            Storage::disk($disk)->delete(basename($value->image));

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image')) {
            $image = Image::make($value);
            $filename = md5($value.time()).'.jpg';
            Storage::disk($disk)->put($filename, $image->stream());
            $this->attributes[$attribute_name] = $destination_path.'/'.$filename;
        }
    }

    /**
     * SliderElement Model boot function.
     */
    protected static function boot()
    {
        parent::boot();

        SliderElement::observe(new SliderElementObserver);
    }
}
