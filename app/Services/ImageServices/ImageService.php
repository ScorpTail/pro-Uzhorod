<?php

namespace App\Services\ImageServices;

use App\Models\Image\Image;
use App\Dto\Images\ImageDto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function add(array $files, string $objectType, int $objectId): bool
    {
        try {
            foreach ($files as $type => $files) {
                $position = 0;
                foreach ($files as $file) {
                    $this->store(new ImageDto(
                        objectId: $objectId,
                        objectType: $objectType,
                        type: $type,
                        position: $position,
                        file: $file
                    ));
                    $position++;
                }
            }
            $isSuccess = true;
        } catch (\Exception $e) {
            $isSuccess = false;
        }

        return $isSuccess;
    }

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

    public function delete(int $id): void
    {
        $image = Image::findOrFail($id);

        Storage::disk()->delete('images/' . strtolower((new \ReflectionClass($image->object_type))->getShortName()) . '/' . $image->object_id . '/' . $image->type . '/' . $image->filename);

        Image::destroy($id);
    }
}
