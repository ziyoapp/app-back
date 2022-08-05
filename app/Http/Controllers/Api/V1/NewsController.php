<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\EntityStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function latest(Request $request)
    {
        $limit = $request->get('limit', 5);

        $newsList = News::query()
                        ->where('status', EntityStatus::PUBLISHED)
                        ->latest('published_at')
                        ->limit($limit)
                        ->get();

        return NewsResource::collection($newsList);
    }

    public function newItem($id)
    {
        $newsItem = News::query()->findOrFail($id);

        return new NewsResource($newsItem);
    }
}
