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
