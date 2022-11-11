<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventCreateRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Http\Requests\ListRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Models\News;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function item(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        return new EventResource($event);
    }

    public function list(ListRequest $request, EventService $eventService)
    {
        $perPage = (int) $request->get('per_page', 15);
        $sort = (string) $request->get('sort', 'desc');

        $eventsList = $eventService->list($perPage, $sort);

        return EventResource::collection($eventsList);
    }

    public function create(EventCreateRequest $request, EventService $eventService)
    {
        $validatedData = $request->validated();
        $event = $eventService->create($validatedData);

        return new EventResource($event);
    }

    public function update(int $eventId, EventUpdateRequest $request, EventService $eventService)
    {
        $validatedData = $request->validated();
        $event = $eventService->update($eventId, $validatedData);

        return new EventResource($event);
    }

    public function delete(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        $event->delete();
        return response()->json();
    }
}
