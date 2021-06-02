<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "username" => "akademik",
            "role_id" => 1,
            "password" => Hash::make("akademik")
        ]);

        User::create([
            "username" => "keuangan",
            "role_id" => 2,
            "password" => Hash::make("keuangan")
        ]);
        User::create([
            "username" => "pemasaran",
            "role_id" => 3,
            "password" => Hash::make("pemasaran")
        ]);
        User::create([
            "username" => "hrd",
            "role_id" => 4,
            "password" => Hash::make("hrd")
        ]);
    }
}
