<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\EntityStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EventsListResource;
use App\Http\Resources\V1\EventsResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * @OA\Get(
     *      path="/events/latest",
     *      operationId="getLatestEvents",
     *      tags={"Events"},
     *      summary="Get latest list of events",
     *      description="Returns latest list of events",
     *     @OA\Parameter(
     *          name="limit",
     *          description="List limit",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EventsCollection")
     *       )
     * )
     */
    public function latest(Request $request)
    {
        $limit = (int) $request->get('limit', 5);

        $eventsList = Event::query()
            ->where('status', EntityStatus::PUBLISHED)
            ->latest('published_at')
            ->limit($limit)
            ->get();

        return EventsResource::collection($eventsList);
    }

    /**
     * @OA\Get(
     *      path="/events",
     *      operationId="getEventsList",
     *      tags={"Events"},
     *      summary="Get list of events",
     *      description="Returns list of events",
     *     @OA\Parameter(
     *          name="page",
     *          description="Page",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="per_page",
     *          description="Per page",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EventsPagination")
     *       )
     * )
     */
    public function eventList(Request $request)
    {
        $type = $request->get('type', 'simple');
        $perPage = (int) $request->get('per_page', 15);

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

    /**
     * @OA\Get(
     *      path="/events/{id}",
     *      operationId="getEventById",
     *      tags={"Events"},
     *      summary="Get event by id",
     *      description="Return event by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Event id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EventsResource")
     *       )
     * )
     */
    public function event($id)
    {
        $event = Event::query()
                        ->where('status', EntityStatus::PUBLISHED)
                        ->findOrFail($id);

        return new EventsResource($event);
    }
}
