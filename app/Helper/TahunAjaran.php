<?php

use App\Models\AbsenDosen;

function tahunAjaran($month = NULL)
{
    if (is_null($month)) $month = date('n');
    $year = date('Y');
    if ($month <= 6) {
        $y = $year - 1;
        $tahunAjaran = "genap-" . $y . "-" . $year;
    } else {
        $y = $year + 1;
        $tahunAjaran = "ganjil-" .  $year . "-" . $y;
    }
    return $tahunAjaran;
}

function listTahunAjaran()
{
    $start = 2020;
    $year = date('Y');
    $month = date('n');
    $loop = $year - $start;
    $dt = [];
    if ($month > 6) $loop = $loop * 2 + 1;
    else $loop = $loop * 2;
    for ($i = 1; $i <= $loop; $i++) {
        if ($i % 2 != 0 && $i != 1) ++$start;
        if ($i % 2 != 0) $dt[] = [
            'id' => "ganjil-$start-" . ($start + 1),
            'text' => "Ganjil $start/" . ($start + 1)
        ];
        else $dt[] = [
            'id' => "genap-$start-" . ($start + 1),
            'text' => "Genap $start/" . ($start + 1)
        ];
    }
    return $dt;
}

function getBulan()
{
    return [
        (object)["id" => 1, "name" => "Januari"],
        (object)["id" => 2, "name" => "Februari"],
        (object)["id" => 3, "name" => "Maret"],
        (object)["id" => 4, "name" => "April"],
        (object)["id" => 5, "name" => "Mei"],
        (object)["id" => 6, "name" => "Juni"],
        (object)["id" => 7, "name" => "Juli"],
        (object)["id" => 8, "name" => "Agustus"],
        (object)["id" => 9, "name" => "September"],
        (object)["id" => 10, "name" => "Oktober"],
        (object)["id" => 11, "name" => "November"],
        (object)["id" => 12, "name" => "Desember"],
    ];
}

function dayInIndonesia($day)
{
    switch ($day) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jumat";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        default:
            $hari_ini = "Tidak di ketahui";
            break;
    }

    return $hari_ini;
}

function totalPertemuan($pgw, $matkul, $kat, $bulan, $tahun)
{
    $total = AbsenDosen::where([
        ['pegawai_id', $pgw],
        ['kategori', $kat],
        ['matakuliah_id', $matkul],
        ['hadir', 1]
    ])->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->count();
    return $total;
}
function absenMatkul($pgw, $kat, $bulan, $tahun)
{
    if (env('DB_CONNECTION') == 'mysql') {
        $total = AbsenDosen::with('matkul')->where([
            ['pegawai_id', $pgw],
            ['kategori', $kat],
            ['hadir', 1]
        ])->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->groupBy('matakuliah_id')->get();
    } else {
        $total = AbsenDosen::with('matkul')->where([
            ['pegawai_id', $pgw],
            ['kategori', $kat],
            ['hadir', 1]
        ])->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->distinct('matakuliah_id')->get();
    }
    return $total;
}
