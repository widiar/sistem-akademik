<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::create([
            "role" => "akademik"
        ]);
        UserRole::create([
            "role" => "keuangan"
        ]);
        UserRole::create([
            "role" => "pemasaran"
        ]);
    }
}
