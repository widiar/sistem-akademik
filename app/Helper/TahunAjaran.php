<?php

function tahunAjaran()
{
    $month = date('n');
    $year = date('Y');
    if ($month <= 6) {
        $y = $year - 1;
        $tahunAjaran = $y . "/" . $year;
    } else {
        $y = $year + 1;
        $tahunAjaran = $year . "/" . $y;
    }
    return $tahunAjaran;
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
