<?php

namespace App\Services\ImageServices;

use App\Models\Image\Image;
use App\Dto\Images\ImageDto;
use Illuminate\Support\Facades\DB;

class ImageService
{
    public function store(ImageDto $imageDto): string
    {
        DB::beginTransaction();

        $basename = strtolower((new \ReflectionClass($imageDto->objectType))->getShortName());

        $filepath = $imageDto->file->storeAs(
            'images/' . $basename . '/' . $imageDto->objectId . '/' . $imageDto->type,
            $imageDto->file->getClientOriginalName(),
            'public'
        );

        if (!$filepath) {
            DB::rollBack();
            throw new \RuntimeException(__('system.image.upload_failed'));
        }

        Image::create([
            'object_id'   => $imageDto->objectId,
            'object_type' => $imageDto->objectType,
            'type'        => $imageDto->type,
            'filename'    => $imageDto->file->getClientOriginalName(),
            'position'    => $imageDto->position,
        ]);

        DB::commit();

        return $filepath;
    }
}
