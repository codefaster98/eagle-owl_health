<?php

namespace App\Http\Controllers\Api\events;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\events\EventsEventsGetAllRequest;
use App\Services\users\EventsEventsServices;
use App\Services\system\SystemApiResponseServices;

class eventsevents extends Controller
{
    public function GetAll(EventsEventsGetAllRequest $request)
    {
        try {
            if ($request->random) {
                $events = EventsEventsServices::GetAllWithLimitAndRandom(null, $request->limit);
            } else {
                $events = EventsEventsServices::GetAllWithLimit(null, $request->limit);
            }

            if (count($events) > 0) {
                return SystemApiResponseServices::ReturnSuccess($events, null, null);
            } else {
                return SystemApiResponseServices::ReturnFailed([], __("return_messages.events_events.NotFound"), null);
            }
        } catch (\Throwable $th) {
            return SystemApiResponseServices::ReturnError(
                9800,
                null,
                $th->getMessage(),
            );
        }
    }
    public function GetAllData(EventsEventsGetAllRequest $request)
{
    try {
        if ($request->random) {
            $events = EventsEventsServices::GetAllWithLimitAndRandom(null, $request->limit);
        } else if ($request->has('date') && !is_null($request->date)) {
            $events = EventsEventsServices::GetAllWithLimitAndLike(null, $request->limit, $request->date);
        } else {
            $events = EventsEventsServices::GetAllWithLimit(null, $request->limit);
        }

        if (count($events) > 0) {
            return SystemApiResponseServices::ReturnSuccess($events, null, null);
        } else {
            return SystemApiResponseServices::ReturnFailed([], __("return_messages.events_events.NotFound"), null);
        }
    } catch (\Throwable $th) {
        return SystemApiResponseServices::ReturnError(
            9800,
            null,
            $th->getMessage(),
        );
    }
}
    public function Details($request_code)
    {
        try {
            $event[] = EventsEventsServices::GetByCode(["Speakers"], $request_code);
            // dd($event);
            if ($event) {
                return SystemApiResponseServices::ReturnSuccess($event, null, null);
            } else {
                return SystemApiResponseServices::ReturnFailed([], __("return_messages.events_events.NotFound"), null);
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
