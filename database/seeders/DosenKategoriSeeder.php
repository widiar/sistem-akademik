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
            ["kategori" => "Pembimbing TA"],
            ["kategori" => "Pembimbing Skripsi"],
            ["kategori" => "Penguji"],
            ["kategori" => "Koordinator"],
            ["kategori" => "Wali"],
            ["kategori" => "Kerja Praktek"],
        ];
        KategoriDosen::insert($data);
    }
}
