<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageServices\ImageService;

class ImageController extends Controller
{
    public function __construct(
        protected ImageService $imageService,
    ) {}

    public function delete(Request $request, $id)
    {
        $this->imageService->delete($id);

        return response()->json(['status' => __('system.image.delete_success')]);
    }
}
