<?php

namespace App\Services\users;

use App\Models\Events\EventsEventsM;

class EventsEventsServices
{

    public function getAllEvents($language)
    {
        if ($language == 'ar') {
            return EventsEventsM::select('id', 'title_ar as title', 'short_desc_ar as description', 'image', 'date', 'from_time', 'location')->get();
        } else {
            return EventsEventsM::select('id', 'title_en as title', 'short_desc_en as description', 'image', 'date', 'from_time', 'location')->get();
        }
    }

    public function show($language,$id)
    {
        if ($language == 'ar') {
            $event = EventsEventsM::with(['speakers' => function ($query) {
                $query->select('id', 'event_id', 'name_ar as name', 'title_ar as title', 'shortDescription_ar as description','longDescription_ar as description', 'image');
            }])->select('id', 'title_ar as title', 'long_desc_ar as description', 'image','price')->find($id);
            return $event;
        } else {
            $event = EventsEventsM::with(['speakers' => function ($query) {
                $query->select('id', 'event_id', 'name_en as name', 'title_en as title', 'shortDescription_en as description','longDescription_en as description', 'image');
            }])->select('id', 'title_en as title', 'long_desc_en as description', 'image','price')->find($id);
            return $event;

        }
    }
}
