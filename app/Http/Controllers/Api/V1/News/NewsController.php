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

        $news->increment('views');

        return response()->json([
            'news' => $news,
        ], 200);
    }
}
