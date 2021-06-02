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
        $data = [
            ["role" => "akademik"],
            ["role" => "keuangan"],
            ["role" => "pemasaran"],
            ["role" => "hrd"],
        ];
        UserRole::insert($data);
    }
}
