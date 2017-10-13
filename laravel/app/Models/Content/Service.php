<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Observers\Content\ServiceObserver;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Service extends Model
{
    use CrudTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services';

    /**
     * Fillable items.
     *
     * @var array
     */
    protected $fillable = ['name', 'image'];

    /**
     * Get the localized contents of a service.
     */
    public function localized_services()
    {
        return $this->hasMany('App\Models\Content\LocalizedService');
    }

    /**
     * Service Model boot function.
     */
    protected static function boot()
    {
        parent::boot();

        Service::observe(new ServiceObserver);
    }

    /**
     * Mutator to store the image
     *
     * @param string $value
     */
    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $disk = "services";
        $destination_path = "/uploads/back_services";

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
}
