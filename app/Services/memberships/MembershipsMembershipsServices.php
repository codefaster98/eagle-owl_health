<?php

namespace App\Services\memberships;

use App\Models\MemberShips\MemberShipsMemberShipM;
use Illuminate\Support\Str;

class MembershipsMembershipsServices
{
    static public function GenerateNewCode()
    {
        $code = Str::random(5);
        if (MemberShipsMemberShipM::where('code', $code)->exists()) {
            return Self::GenerateNewCode();
        } else {
            return $code;
        }
    }
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
    static public function GetByCode(array|null $Relations, $mships_code)
    {
        if ($Relations) {
            return MemberShipsMemberShipM::where('code', $mships_code)->with($Relations)->get();
        } else {
            return MemberShipsMemberShipM::where('code', $mships_code)->get();
        }
    }
}
