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
        return Dosen::where('is_dosen', true)->get();
    }

    public function map($dosen): array
    {
        $sks = $dosen->sks()->where('tahun_ajaran', $this->tahunAjaran())->first();
        $pembimbing = $dosen->pembimbing()->where('tahun_ajaran', $this->tahunAjaran())->first();
        $penguji = $dosen->penguji()->where('tahun_ajaran', $this->tahunAjaran())->first();
        $koor = $dosen->koordinator()->where('tahun_ajaran', $this->tahunAjaran())->first();
        $wali = $dosen->wali()->where('tahun_ajaran', $this->tahunAjaran())->first();
        $k = '';
        foreach ($dosen->kategori as $kategori) {
            $k .= $kategori->kategori . ", ";
        }
        return [
            $dosen->nip,
            $dosen->nama,
            $k,
            ($sks) ? $sks->semester_ganjil : '',
            ($sks) ? $sks->semester_genap : '',
            ($pembimbing) ? $pembimbing->semester_ganjil : '',
            ($pembimbing) ? $pembimbing->semester_genap : '',
            ($penguji) ? $penguji->semester_ganjil : '',
            ($penguji) ? $penguji->semester_genap : '',
            ($koor) ? $koor->semester_ganjil : '',
            ($koor) ? $koor->semester_genap : '',
            ($wali) ? $wali->semester_ganjil : '',
            ($wali) ? $wali->semester_genap : '',
        ];
    }

    public function headings(): array
    {
        return [
            [
                'NIP',
                'NAMA',
                'KATEGORI',
                'Jumlah SKS',
                '',
                'Jumlah Pembimbing',
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
