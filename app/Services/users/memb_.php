<?php

// namespace App\Services\users;

// use App\Models\MemberShips\MemberShipsMemberShipM;

// class MemberShipsMembershipServices
// {
//     public function memberShips($language)
//     {
//         if ($language == 'ar') {
//             return MemberShipsMemberShipM::select('id', 'name_ar as name', 'list_ar as list', 'amount')->get();
//         } else {
//             return MemberShipsMemberShipM::select('id', 'name_en as name', 'list_en as list', 'amount')->get();
//         }
//     }
//     public function show($language,$id)
//     {
//         if ($language == 'ar') {
//             $event =  MemberShipsMemberShipM::select('id', 'name_ar as name','amount')->find($id);
//             return $event;
//         } else {
//             $event =  MemberShipsMemberShipM::select('id', 'name_en as name','amount')->find($id);
//             return $event;

//         }
//     }
// }