<?php

namespace App\Exports;

use App\Models\AbsenDosen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AbsenDosenExport implements FromCollection, WithMapping, WithHeadings
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
        $sks = $dosen->sks()->where('tahun_ajaran', $this->tahunAjaran())->first();
        $ganjil = -1;
        $genap = -1;
        if ($sks) {
            if ($sks->semester_ganjil) $ganjil = $sks->semester_ganjil * 24;
            if ($sks->semester_genap) $genap = $sks->semester_genap * 24;
        }

        $jan = $dosen->absen()->where('tahun_ajaran', $this->tahunAjaran())->where('bulan', 1)->first();
        $feb = $dosen->absen()->where('tahun_ajaran', $this->tahunAjaran())->where('bulan', 2)->first();
        $mar = $dosen->absen()->where('tahun_ajaran', $this->tahunAjaran())->where('bulan', 3)->first();
        $apr = $dosen->absen()->where('tahun_ajaran', $this->tahunAjaran())->where('bulan', 4)->first();
        $mei = $dosen->absen()->where('tahun_ajaran', $this->tahunAjaran())->where('bulan', 5)->first();
        $jun = $dosen->absen()->where('tahun_ajaran', $this->tahunAjaran())->where('bulan', 6)->first();
        $gp = $dosen->absen()->where('tahun_ajaran', $this->tahunAjaran())->where('bulan', '<=', 6)->sum('absen');
        $pGenap = ($gp / $genap) * 100;

        $jul = $dosen->absen()->where('tahun_ajaran', $this->tahunAjaran())->where('bulan', 7)->first();
        $aug = $dosen->absen()->where('tahun_ajaran', $this->tahunAjaran())->where('bulan', 8)->first();
        $sept = $dosen->absen()->where('tahun_ajaran', $this->tahunAjaran())->where('bulan', 9)->first();
        $okt = $dosen->absen()->where('tahun_ajaran', $this->tahunAjaran())->where('bulan', 10)->first();
        $nov = $dosen->absen()->where('tahun_ajaran', $this->tahunAjaran())->where('bulan', 11)->first();
        $des = $dosen->absen()->where('tahun_ajaran', $this->tahunAjaran())->where('bulan', 12)->first();
        $gl = $dosen->absen()->where('tahun_ajaran', $this->tahunAjaran())->where('bulan', '>', 6)->sum('absen');
        $pGanjil = ($gl / $ganjil) * 100;

        return [
            $absen->dosen->nip,
            $absen->dosen->nama,
            ($jan) ? $jan->absen : '',
            ($feb) ? $feb->absen : '',
            ($mar) ? $mar->absen : '',
            ($apr) ? $apr->absen : '',
            ($mei) ? $mei->absen : '',
            ($jun) ? $jun->absen : '',
            ($jul) ? $jul->absen : '',
            ($aug) ? $aug->absen : '',
            ($sept) ? $sept->absen : '',
            ($okt) ? $okt->absen : '',
            ($nov) ? $nov->absen : '',
            ($des) ? $des->absen : '',
            ($pGanjil <= 0) ? '' : number_format($pGanjil, 2, ',', '.') . "%",
            ($pGenap <= 0) ? '' : number_format($pGenap, 2, ',', '.') . "%",
            $this->tahunAjaran(),
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

    public function tahunAjaran()
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
}
