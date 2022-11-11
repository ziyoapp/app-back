<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListRequest;
use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function item(int $newsId)
    {
        $news = News::findOrFail($newsId);
        return new NewsResource($news);
    }

    public function list(ListRequest $request, NewsService $newsService)
    {
        $perPage = (int) $request->get('per_page', 15);
        $sort = (string) $request->get('sort', 'desc');

        $newsList = $newsService->list($perPage, $sort);

        return NewsResource::collection($newsList);
    }

    public function create(NewsCreateRequest $request, NewsService $newsService)
    {
        $validatedData = $request->validated();
        $news = $newsService->create($validatedData);

        return new NewsResource($news);
    }

    public function update(int $newsId, NewsUpdateRequest $request, NewsService $newsService)
    {
        $validatedData = $request->validated();
        $news = $newsService->update($newsId, $validatedData);

        return new NewsResource($news);
    }

    public function delete(int $newsId)
    {
        $news = News::findOrFail($newsId);
        $news->delete();
        return response()->json();
    }
}
