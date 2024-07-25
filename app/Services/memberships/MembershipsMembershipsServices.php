<?php

namespace App\Services\memberships;

use App\Models\MemberShips\MemberShipsMemberShipM;

class MembershipsMembershipsServices
{
    static public function GetAllWithLimit(array|null $Relations, int $limit)
    {
        if ($Relations) {
            return MemberShipsMemberShipM::limit($limit)->with($Relations)->get();
        } else {
            return MemberShipsMemberShipM::limit($limit)->get();
        }
    }
    static public function GetAllWithLimitAndRandom(array|null $Relations, int $limit)
    {
        if ($Relations) {
            return MemberShipsMemberShipM::inRandomOrder()->limit($limit)->with($Relations)->get();
        } else {
            return MemberShipsMemberShipM::inRandomOrder()->limit($limit)->get();
        }
    }
}
