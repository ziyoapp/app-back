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
    /**
     * @OA\Get(
     *      path="/dashboard/events/{id}",
     *      operationId="getDashEventById",
     *      tags={"Dashboard Events"},
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
     *          @OA\JsonContent(ref="#/components/schemas/DashboardEventsResource")
     *       )
     * )
     */
    public function item(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        return new EventResource($event);
    }

    /**
     * @OA\Get(
     *      path="/dashboard/events/list",
     *      operationId="getDashEventsList",
     *      tags={"Dashboard Events"},
     *      summary="Get events list",
     *      description="Return events list",
     *     @OA\Parameter(
     *          name="sort",
     *          description="Sort by published at [asc, desc]",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
     *          @OA\JsonContent(ref="#/components/schemas/DashboardEventsCollection")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function list(ListRequest $request, EventService $eventService)
    {
        $perPage = (int) $request->get('per_page', 15);
        $sort = (string) $request->get('sort', 'desc');

        $eventsList = $eventService->list($perPage, $sort);

        return EventResource::collection($eventsList);
    }

    /**
     * @OA\Post(
     *      path="/dashboard/events",
     *      operationId="createEventsDash",
     *      tags={"Dashboard Events"},
     *      summary="Create event",
     *      description="Create event",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/DashboardEventsRequest")
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DashboardEventsResource")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function create(EventCreateRequest $request, EventService $eventService)
    {
        $validatedData = $request->validated();
        $event = $eventService->create($validatedData);

        return new EventResource($event);
    }

    /**
     * @OA\Put(
     *      path="/dashboard/events/{id}",
     *      operationId="updateEventsDash",
     *      tags={"Dashboard Events"},
     *      summary="Update event",
     *      description="Update event",
     *     @OA\Parameter(
     *          name="id",
     *          description="Event id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="_method",
     *          description="HTTP PUT: [only - PUT]",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/DashboardEventsRequest")
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DashboardEventsResource")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function update(int $eventId, EventUpdateRequest $request, EventService $eventService)
    {
        $validatedData = $request->validated();
        $event = $eventService->update($eventId, $validatedData);

        return new EventResource($event);
    }

    /**
     * @OA\Delete(
     *      path="/dashboard/events/{id}",
     *      operationId="deleteDashEventById",
     *      tags={"Dashboard Events"},
     *      summary="Delete event by id",
     *      description="Delete event by id",
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
     *          description="Successful operation"
     *       )
     * )
     */
    public function delete(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        $event->delete();
        return response()->json();
    }
}
