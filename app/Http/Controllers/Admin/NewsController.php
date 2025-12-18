<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusEnum;
use App\Models\News\News;
use App\Dto\Images\ImageDto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageServices\ImageService;

class NewsController extends Controller
{
    public function __construct(
        protected ImageService $imageService,
    ) {}

    public function index(Request $request)
    {
        $news = News::get();

        return response()->json($news);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'             => ['required', 'string', 'max:255'],
            'content'           => ['required', 'string'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'status'            => ['required', 'in:' . StatusEnum::getColumnLikeString('value')],
            'files.*'           => ['sometimes', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $newsData = $request->all();

        $news = News::create([
            'title'             => $newsData['title'],
            'content'           => $newsData['content'],
            'short_description' => $newsData['short_description'] ?? null,
            'status'            => $newsData['status'],
            'user_id'           => auth()->id()
        ]);

        $this->imageService->add($request->allFiles()['files'] ?? [], News::class, $news->id);

        return response()->json(['message' => __('admin.news_created_successfully'), 'news' => $news], 201);
    }

    public function edit(Request $request, $id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => __('admin.news_not_found')], 404);
        }

        return response()->json($news);
    }

    public function update(Request $request, $id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => __('admin.news_not_found')], 404);
        }

        $validatedData = $request->validate([
            'title'             => ['sometimes', 'string', 'max:255'],
            'content'           => ['sometimes', 'string'],
            'short_description' => ['sometimes', 'string', 'max:500'],
            'status'            => ['sometimes', 'in:' . StatusEnum::getColumnLikeString('value')],
            'files.*.*'           => ['sometimes', 'file', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $news->update($validatedData);

        $this->imageService->add($request->allFiles()['files'] ?? [], News::class, $news->id);

        return response()->json(['message' => __('admin.news_updated_successfully'), 'news' => $news]);
    }

    public function destroy(Request $request, $id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => __('admin.news_not_found')], 404);
        }

        $news->images()->delete();

        $news->delete();

        return response()->json(['message' => __('admin.news_deleted_successfully')]);
    }
}
