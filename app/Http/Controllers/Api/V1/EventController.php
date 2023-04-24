<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\BonusLogOperation;
use App\Enums\BonusLogType;
use App\Enums\EntityStatus;
use App\Exceptions\BadRequestException;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BonusAddRequest;
use App\Http\Resources\V1\EventsListResource;
use App\Http\Resources\V1\EventsResource;
use App\Models\BonusLog;
use App\Models\BonusLogProp;
use App\Models\Event;
use App\Notifications\UserEventRegistered;
use App\Services\V1\BonusLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * @var BonusLogService
     */
    protected $bonusLogService;

    public function __construct()
    {
        $this->bonusLogService = new BonusLogService();
    }

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
     *          name="type",
     *          description="Type events: simple | exclusive",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
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
     *          @OA\JsonContent(ref="#/components/schemas/EventsPagination")
     *       )
     * )
     */
    public function eventList(Request $request)
    {
        $type = $request->get('type');
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

    /**
     * @OA\Get(
     *      path="/events/category/{stringId}",
     *      operationId="getEventsByCategory",
     *      tags={"Events"},
     *      summary="Get list of events [all | new | free | exclusive | past]",
     *      description="Get list of events",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EventsPagination")
     *       )
     * )
     */
    public function categoryEvent(string $eventCategoryId, Request $request)
    {
        $events = Event::query()->where('status', EntityStatus::PUBLISHED);
        $perPage = (int) $request->get('per_page', 15);
        $sort = $request->get('order', 'asc');

        switch ($eventCategoryId) {
            case 'new':
                $events->where('date_start_at', '>', now()->toDateTimeString());
                break;
            case 'free':
                $events->whereIn('price_ball', [0, null]);
                break;
            case 'exclusive':
                $events->where('price_ball', '>', 0);
                break;
            case 'past':
                $events->where('date_start_at', '<', now()->toDateTimeString());
                break;
        }

        $events->orderBy('id', $sort);

        return EventsListResource::collection($events->paginate($perPage));
    }

    /**
     * @OA\Get(
     *      path="/events/category",
     *      operationId="getEventsCategories",
     *      tags={"Events"},
     *      summary="Get list of event categories",
     *      description="Get list of event categories",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EventCategoryCollection")
     *       )
     * )
     */
    public function eventsCategory()
    {
        $event = Event::query()->where('status', EntityStatus::PUBLISHED);

        $eventCategories = collect([
            [
                'id' => 'all',
                'name' => __('Все события'),
                'events_count' => $event->count()
            ],
            [
                'id' => 'new',
                'name' => __('Новые'),
                'events_count' => $event
                    ->where('date_start_at', '>', now()->toDateTimeString())->count()
            ],
            [
                'id' => 'free',
                'name' => __('Бесплатные'),
                'events_count' => Event::query()->where('status', EntityStatus::PUBLISHED)
                    ->whereIn('price_ball', [0, null])->count()
            ],
            [
                'id' => 'exclusive',
                'name' => __('Эксклюзивные'),
                'events_count' => Event::query()->where('status', EntityStatus::PUBLISHED)
                    ->where('price_ball', '>', 0)->count()
            ],
            [
                'id' => 'past',
                'name' => __('Прошедшие'),
                'events_count' => Event::query()->where('status', EntityStatus::PUBLISHED)
                    ->where('date_start_at', '<', now()->toDateTimeString())->count()
            ]
        ]);

        return response()->json([
            'data' => $eventCategories
        ]);
    }

    /**
     * @OA\Get(
     *      path="/events/active/{user_id}/user",
     *      operationId="getCurrentActiveEvents",
     *      tags={"Admin events"},
     *      summary="Get active events for admin",
     *      description="Get active events for admin",
     *     @OA\Parameter(
     *          name="user_id",
     *          description="User id",
     *          required=true,
     *          in="path",
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
    public function getActiveEvents($userId)
    {
        $eventsList = Event::currentDayActiveEvents();

        $eventIds = $eventsList->pluck('id')->implode(',');

        if ($eventIds) {
            $entityType = "App\\Models\\Event";

            $result = DB::select(
                DB::raw("
                    SELECT prop.entity_id as event_id FROM bonus_logs log
                    INNER JOIN bonus_log_props prop ON prop.bonus_log_id = log.id AND prop.entity_type = :type AND prop.entity_id IN ({$eventIds})
                    WHERE log.user_id = {$userId}
                "), ['type' => $entityType]);

            $ids = array_map(function ($item) {
                return $item->event_id;
            }, $result);

            $eventsList = $eventsList->filter(function ($event) use ($ids) {
                return !in_array($event->id, $ids);
            });
        }

        return EventsResource::collection($eventsList);
    }

    /**
     * @OA\Post(
     *      path="/events/{id}/add-ball",
     *      operationId="addBallForEvent",
     *      tags={"Admin events"},
     *      summary="Add ball for event",
     *      description="Add ball for event",
     *      @OA\Parameter(
     *          name="id",
     *          description="Event id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserIdRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       )
     * )
     */
    public function addBalanceForEvent($id, BonusAddRequest $request)
    {
        $userId = (int) $request->get('user_id');

        $event = Event::query()
            ->where('status', EntityStatus::PUBLISHED)
            ->findOrFail($id);

        if ((float)$event->ball <= 0) {
            throw new BadRequestException(__('bad_request.ball_zero'));
        }

        $this->bonusLogService->updateUserBalance(
            $userId,
            $event->ball,
            BonusLogType::EVENT,
            BonusLogOperation::ADD,
            new BonusLogProp([
                'entity_id' => $event->id,
                'entity_type' => Event::class
            ])
        );

        return response()->noContent(200);
    }

    /**
     * @OA\Post(
     *      path="/events/{id}/add-user",
     *      operationId="addUserToEvent",
     *      tags={"Events"},
     *      summary="Add user to event",
     *      description="Add user to event",
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
     *       ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/BadRequest")
     *      )
     * )
     */
    public function addUser($id)
    {
        /**
         * @var Event $event
         */
        $event = Event::query()
            ->withCount('users')
            ->where('status', EntityStatus::PUBLISHED)
            ->findOrFail($id);

        $eventExist = $event->users()->where('user_id', auth()->id())->exists();
        if ($eventExist) {
            throw new BadRequestException(__('bad_request.event_user_already_exists'));
        }

        if ($event->users_count >= $event->register_count) {
            throw new BadRequestException(__('bad_request.event_users_limit'));
        }

        $event->users()->sync([
            auth()->id() => ['price_ball' => $event->price_ball]
        ]);

        auth()->user()->notify(new UserEventRegistered($event));

        return response()->json();
    }

    /**
     * @OA\Delete(
     *      path="/events/{id}/undo-user",
     *      operationId="undoUserToEvent",
     *      tags={"Events"},
     *      summary="Undo user from event",
     *      description="Undo user from event",
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
     *       ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/BadRequest")
     *      )
     * )
     */
    public function undoUser($id)
    {
        $event = Event::query()
            ->withCount('users')
            ->where('status', EntityStatus::PUBLISHED)
            ->findOrFail($id);

        if ($event->date_start_at < now()->addHours(24)) {
            throw new BadRequestException(__('bad_request.event_time_detach_over'));
        }

        $event->users()->detach(auth()->id());

        return response()->json();
    }
}
