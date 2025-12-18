<?php

namespace App\Dto\Images;

use Illuminate\Http\UploadedFile;

class ImageDto
{
    public function __construct(
        readonly public int $objectId,
        readonly public string $objectType,
        readonly public string $type,
        readonly public int $position,
        readonly public UploadedFile $file,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            objectId: $data['objectId'],
            objectType: $data['objectType'],
            type: $data['type'],
            position: $data['position'],
            file: $data['file'],
        );
    }
}
