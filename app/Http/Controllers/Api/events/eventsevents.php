<?php

namespace App\Http\Controllers\Api\events;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\users\EventsEventsServices;
use App\Services\system\SystemApiResponseServices;

class eventsevents extends Controller
{
    protected $eventService;

    public function __construct(EventsEventsServices $eventService)
    {
        $this->eventService = $eventService;
    }

    public function getAllEvents(Request $request): JsonResponse
    {
        try {
            $language = $request->query('lang', 'en');

            $events = DB::transaction(function () use ($language) {
                return $this->eventService->getAllEvents($language);
            });

            if ($events) {
                return SystemApiResponseServices::ReturnSuccess(
                    ["events" => $events],
                    null,
                    null
                );
            } else {
                return SystemApiResponseServices::ReturnFailed(
                    [],
                    __("return_messages.events_events.eventsFailed"),
                    null
                );
            }
        } catch (\Throwable $th) {
            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $th->getMessage(),
            );
        }
    }

    public function show(Request $request, $id): JsonResponse
    {
        try {
            $language = $request->query('lang', 'en');
            $event = DB::transaction(function () use ($id, $language) {
                return $this->eventService->show($id, $language);
            });

            if ($event) {
                return SystemApiResponseServices::ReturnSuccess(
                    ["event" => $event],
                    null,
                    null
                );
            } else {
                return SystemApiResponseServices::ReturnFailed(
                    [],
                    __("return_messages.events_events.eventsFailed"),
                    null
                );
            }
        } catch (\Throwable $th) {
            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $th->getMessage(),
            );
        }
    }
}
