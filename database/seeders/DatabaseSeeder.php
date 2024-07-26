<?php

namespace Database\Seeders;

use App\Models\Admin\AdminUsersAdminM;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AdminUsersAdminM::create(
            [
                'code' => 321,
                'name' => "bhry",
                'email' => "bhry@bhry.local",
                'phone' => "01097033958",
                'password' => "321",
            ]
        );
    }
}
