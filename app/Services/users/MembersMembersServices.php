<?php

namespace App\Services\users;

use Illuminate\Support\Str;
use App\Models\Members\MembersMembersM;
use Illuminate\Http\Request;

class MembersMembersServices
{
    public function getMembers($language)
    {
        if ($language == 'ar') {
            return MembersMembersM::select('id', 'name_ar as name', 'title_ar as title', 'desc_ar as description', 'image', 'facebook', 'twitter', 'website')->get();
        } else {
            return MembersMembersM::select('id', 'name_en as name', 'title_en as title', 'desc_en as description', 'image', 'facebook', 'twitter', 'website')->get();
        }
    }
}
