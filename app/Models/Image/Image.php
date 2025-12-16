<?php

namespace App\Models\Image;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

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

    public function getFrontUrlAttribute()
    {
        return asset(sprintf('storage/%s/%s', $this->file_path, $this->filename));
    }

    public function getFilePathAttribute()
    {
        return sprintf('images/%s/%d', basename($this->object_type), $this->object_id);
    }

    public static function add(int $objectId, string $objectType, UploadedFile $file, string $type = 'main', int $position = 0): self
    {
        DB::beginTransaction();

        $image              = new self();
        $image->object_id   = $objectId;
        $image->object_type = $objectType;
        $image->type        = $type;
        $image->filename    = $file->getClientOriginalName();
        $image->position    = $position;


        $wasCreated = $file->storeAs($image->file_path, $image->filename, 'public');

        if (!$wasCreated) {
            DB::rollBack();
            throw new \RuntimeException(__('system.image.upload_failed'));
        }

        $image->save();
        DB::commit();

        return $image;
    }
}
