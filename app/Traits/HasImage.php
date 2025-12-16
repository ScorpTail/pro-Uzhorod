<?php

namespace App\Traits;

use App\Models\Image\Image;

trait HasImage
{
    public function images()
    {
        return $this->morphMany(Image::class, 'object', 'object_type', 'object_id')->orderBy('position', 'asc');
    }

    public function main()
    {
        return $this->morphMany(Image::class, 'object', 'object_type', 'object_id')->where('type', 'main')->orderBy('position', 'asc');
    }

    public function icon()
    {
        return $this->morphMany(Image::class, 'object', 'object_type', 'object_id')->where('type', 'icon')->orderBy('position', 'asc');
    }
}
