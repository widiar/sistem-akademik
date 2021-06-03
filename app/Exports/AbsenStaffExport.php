<?php

namespace App\Exports;

use App\Models\AbsenDosen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AbsenStaffExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return AbsenDosen::groupBy('dosen_id')->get();
    }

    public function map($absen): array
    {
        $dosen = $absen->dosen;
        $dt = false;
        if ($dosen->is_staff) $dt = true;
        $sks = $dosen->sks()->where('tahun_ajaran', tahunAjaran())->first();
        $ganjil = -1;
        $genap = -1;
        if ($sks) {
            if ($sks->semester_ganjil) $ganjil = $sks->semester_ganjil * 24;
            if ($sks->semester_genap) $genap = $sks->semester_genap * 24;
        }

        $jan = $dosen->absen()->where('tahun_ajaran', tahunAjaran())->where('bulan', 1)->first();
        $feb = $dosen->absen()->where('tahun_ajaran', tahunAjaran())->where('bulan', 2)->first();
        $mar = $dosen->absen()->where('tahun_ajaran', tahunAjaran())->where('bulan', 3)->first();
        $apr = $dosen->absen()->where('tahun_ajaran', tahunAjaran())->where('bulan', 4)->first();
        $mei = $dosen->absen()->where('tahun_ajaran', tahunAjaran())->where('bulan', 5)->first();
        $jun = $dosen->absen()->where('tahun_ajaran', tahunAjaran())->where('bulan', 6)->first();
        $gp = $dosen->absen()->where('tahun_ajaran', tahunAjaran())->where('bulan', '<=', 6)->sum('absen');
        $pGenap = ($gp / $genap) * 100;

        $jul = $dosen->absen()->where('tahun_ajaran', tahunAjaran())->where('bulan', 7)->first();
        $aug = $dosen->absen()->where('tahun_ajaran', tahunAjaran())->where('bulan', 8)->first();
        $sept = $dosen->absen()->where('tahun_ajaran', tahunAjaran())->where('bulan', 9)->first();
        $okt = $dosen->absen()->where('tahun_ajaran', tahunAjaran())->where('bulan', 10)->first();
        $nov = $dosen->absen()->where('tahun_ajaran', tahunAjaran())->where('bulan', 11)->first();
        $des = $dosen->absen()->where('tahun_ajaran', tahunAjaran())->where('bulan', 12)->first();
        $gl = $dosen->absen()->where('tahun_ajaran', tahunAjaran())->where('bulan', '>', 6)->sum('absen');
        $pGanjil = ($gl / $ganjil) * 100;

        return [
            ($dt) ? $absen->dosen->nip : '',
            ($dt) ? $absen->dosen->nama : '',
            ($jan && $dt) ? $jan->absen : '',
            ($feb && $dt) ? $feb->absen : '',
            ($mar && $dt) ? $mar->absen : '',
            ($apr && $dt) ? $apr->absen : '',
            ($mei && $dt) ? $mei->absen : '',
            ($jun && $dt) ? $jun->absen : '',
            ($jul && $dt) ? $jul->absen : '',
            ($aug && $dt) ? $aug->absen : '',
            ($sept && $dt) ? $sept->absen : '',
            ($okt && $dt) ? $okt->absen : '',
            ($nov && $dt) ? $nov->absen : '',
            ($des && $dt) ? $des->absen : '',
            ($pGanjil <= 0 && !$dt) ? '' : number_format($pGanjil, 2, ',', '.') . "%",
            ($pGenap <= 0 && !$dt) ? '' : number_format($pGenap, 2, ',', '.') . "%",
            ($dt) ? tahunAjaran() : '',
        ];
    }

    public function headings(): array
    {
        return [
            [
                'NIP',
                'NAMA',
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember',
                'Semester Ganjil',
                'Semester Genap',
                'Tahun Ajaran',
            ],
        ];
    }
}
