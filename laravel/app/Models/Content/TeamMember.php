<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Observers\Content\TeamMemberObserver;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TeamMember extends Model
{
    use CrudTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'team_members';

    /**
     * Fillable items.
     *
     * @var array
     */
    protected $fillable = ['name', 'image'];

    /**
     * Get the localized contents of a section.
     */
    public function localized_team_members()
    {
        return $this->hasMany('App\Models\Content\LocalizedTeamMember');
    }

    /**
     * Service Model boot function.
     */
    protected static function boot()
    {
        parent::boot();

        TeamMember::observe(new TeamMemberObserver);
    }

    /**
     * Mutator to store the image
     */
    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $disk = "photos";
        $destination_path = "/uploads/team_images";

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
