<?php

namespace App\Exports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DosenExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Dosen::where('staf_akademik', true)->get();
    }

    public function map($dosen): array
    {
        $sks = $dosen->kategori()->where('kategori_id', 1)->wherePivot('tahun_ajaran', tahunAjaran())->first();
        $pembimbing = $dosen->kategori()->where('kategori_id', 2)->wherePivot('tahun_ajaran', tahunAjaran())->first();
        $penguji = $dosen->kategori()->where('kategori_id', 3)->wherePivot('tahun_ajaran', tahunAjaran())->first();
        $koor = $dosen->kategori()->where('kategori_id', 4)->wherePivot('tahun_ajaran', tahunAjaran())->first();
        $wali = $dosen->kategori()->where('kategori_id', 5)->wherePivot('tahun_ajaran', tahunAjaran())->first();
        $k = '';
        foreach ($dosen->kategori as $kategori) {
            $k .= $kategori->kategori . ", ";
        }
        return [
            $dosen->nip,
            $dosen->nama,
            $k,
            ($sks) ? $sks->pivot->semester_ganjil : '',
            ($sks) ? $sks->pivot->semester_genap : '',
            ($pembimbing) ? $pembimbing->pivot->semester_ganjil : '',
            ($pembimbing) ? $pembimbing->pivot->semester_genap : '',
            ($penguji) ? $penguji->pivot->semester_ganjil : '',
            ($penguji) ? $penguji->pivot->semester_genap : '',
            ($koor) ? $koor->pivot->semester_ganjil : '',
            ($koor) ? $koor->pivot->semester_genap : '',
            ($wali) ? $wali->pivot->semester_ganjil : '',
            ($wali) ? $wali->pivot->semester_genap : '',
        ];
    }

    public function headings(): array
    {
        return [
            [
                'NIP',
                'NAMA',
                'KATEGORI',
                'Jumlah Pembimbing KP',
                '',
                'Jumlah Pembimbing TA',
                '',
                'Jumlah Penguji',
                '',
                'Jumlah Koor',
                '',
                'Jumlah Wali',
                '',
            ],
            [
                '', '', '',
                'Ganjil', 'Genap',
                'Ganjil', 'Genap',
                'Ganjil', 'Genap',
                'Ganjil', 'Genap',
                'Ganjil', 'Genap'
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
