<?php

namespace App\Services\users;

use App\Models\Events\EventsEventsM;

class EventsEventsServices
{

    static public function GetAllWithLimit(array|null $Relations, int $limit)
    {
        if ($Relations) {
            return EventsEventsM::limit($limit)->with($Relations)->get();
        } else {
            return EventsEventsM::limit($limit)->get();
        }
    }
    static public function GetAllWithLimitAndRandom(array|null $Relations, int $limit)
    {
        if ($Relations) {
            return EventsEventsM::inRandomOrder()->limit($limit)->with($Relations)->get();
        } else {
            return EventsEventsM::inRandomOrder()->limit($limit)->get();
        }
    }
    static public function GetAllWithLimitAndLike(array|null $Relations, int $limit, string $date)
    {
        if ($Relations) {
            return EventsEventsM::where('date_details', 'like', $date)->limit($limit)->with($Relations)->get();
        } else {
            return EventsEventsM::where('date_details', 'like', $date)->limit($limit)->get();
        }
    }
    static public function GetByCode(array|null $Relations, $event_code)
    {
        if ($Relations) {
            return EventsEventsM::where('code', $event_code)->with($Relations)->first();
        } else {
            return EventsEventsM::where('code', $event_code)->first();
        }
    }
}
