<?php

namespace App\Models\Image;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'object_id',
        'object_type',
        'type',
        'filename',
        'position',
    ];

    public function getImageTypeAttribute()
    {
        return Storage::disk()->url($this->file_path . '/' . $this->filename);
    }

    public function getFrontUrlAttribute()
    {
        return Storage::disk()->url($this->file_path . '/' . $this->filename);
    }

    public function getFilePathAttribute()
    {
        $ref = new \ReflectionClass($this->object_type);
        $basename = strtolower($ref->getShortName());

        return sprintf('images/%s/%d/%s', $basename, $this->object_id, $this->type);
    }
}
