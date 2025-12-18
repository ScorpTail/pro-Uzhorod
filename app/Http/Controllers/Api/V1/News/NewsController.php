<?php

namespace App\Http\Controllers\Api\V1\News;

use App\Enums\StatusEnum;
use App\Models\News\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $news = News::where('status', StatusEnum::ACTIVE->value)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($news as $item) {
            foreach ($item->images as $file) {
                $item->setAttribute($file->image_type, $file->front_url);
            }
        }

        return response()->json([
            'news' => $news,
        ], 200);
    }

    public function show(Request $request, $id)
    {
        $news = News::where('id', $id)
            ->where('status', StatusEnum::ACTIVE->value)
            ->first();

        if (!$news) {
            return response()->json([
                'message' => __('front.news.not_found'),
            ], 404);
        }

        foreach ($news->images as $item) {
            $news->setAttribute($item->image_type, $item->front_url);
        }

        $news->increment('views');

        return response()->json([
            'news' => $news,
        ], 200);
    }
}
