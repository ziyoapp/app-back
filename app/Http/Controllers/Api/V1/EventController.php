<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\EntityStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EventsCollection;
use App\Http\Resources\V1\EventsListResource;
use App\Http\Resources\V1\EventsResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function eventList(Request $request)
    {
        $type = $request->get('type', 'simple');
        $perPage = $request->get('per_page', 15);

        $events = Event::query();

        if ($type === 'simple') {
            $events->where('price_ball', '<=', 0)
                    ->orWhereNull('price_ball');
        } else if ($type === 'exclusive') {
            $events->where('price_ball', '>', 0);
        }

        $events->where('status', EntityStatus::PUBLISHED)->orderByDesc('published_at');

        return EventsListResource::collection($events->paginate($perPage));
    }

    public function event($id)
    {
        $event = Event::query()
                        ->where('status', EntityStatus::PUBLISHED)
                        ->findOrFail($id);

        return new EventsResource($event);
    }
}
