<?php

namespace Database\Seeders;

use App\Models\KategoriDosen;
use Illuminate\Database\Seeder;

class DosenKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["kategori" => "Pengajar"],
            ["kategori" => "Pembimbing KP / TA"],
            ["kategori" => "Penguji KP / TA"],
            ["kategori" => "Koordinator"],
            ["kategori" => "Wali"],
        ];
        KategoriDosen::insert($data);
    }
}
