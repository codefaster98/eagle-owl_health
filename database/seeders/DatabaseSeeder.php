<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin\AdminUsersAdminM;
use App\Models\Events\EventsEventUsersM;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // AdminUsersAdminM::create(
        //     [
        //         'code' => 321,
        //         'name' => "bhry",
        //         'email' => "bhry@bhry.local",
        //         'phone' => "01097033958",
        //         'password' => "321",
        //     ]

        //  'events_id',
        // 'users_id',
        // 'payment_id',
        // 'payment_details',
        // 'time', php artisan db:seed

        // );
        EventsEventUsersM::create(
            [
                'events_id' => 2,
                'users_id' => 8,
                'payment_id' => "pay1234598",
                'payment_details' => json_encode(['method' => 'Visa']),
                'time' => "11.30",
            ]
        );


    }
}
