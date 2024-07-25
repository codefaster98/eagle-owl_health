<?php

namespace App\Services\form_requests;

use App\Models\Members\MembersMembersM;


class FormRequestsFormServices
{
    static public function GetAllWithLimit(array|null $Relations, int $limit)
    {
        if ($Relations) {
            return MembersMembersM::limit($limit)->with($Relations)->get();
        } else {
            return MembersMembersM::limit($limit)->get();
        }
    }
    static public function GetAllWithLimitAndRandom(array|null $Relations, int $limit)
    {
        if ($Relations) {
            return MembersMembersM::inRandomOrder()->limit($limit)->with($Relations)->get();
        } else {
            return MembersMembersM::inRandomOrder()->limit($limit)->get();
        }
    }
}
