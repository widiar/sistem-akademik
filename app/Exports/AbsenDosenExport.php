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
    protected $bulan;
    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function collection()
    {
        return AbsenDosen::whereMonth('tanggal', $this->bulan)->whereYear('tanggal', date('Y'))->orderBy('tanggal')->get();
    }

    public function map($absen): array
    {
        $hadir = '';
        if ($absen->hadir == 1) $hadir = 'Hadir';
        else $hadir = 'Tidak Hadir';
        return [
            $absen->dosen->nip,
            $absen->dosen->nama,
            $absen->matkul->nama,
            $absen->tanggal,
            $hadir,
        ];
    }

    public function headings(): array
    {
        return [
            [
                'NIP',
                'NAMA',
                'Matakuliah',
                'Tanggal',
                'Hadir',
            ],
        ];
    }
}
