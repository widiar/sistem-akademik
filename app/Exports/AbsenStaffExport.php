<?php

namespace App\Exports;

use App\Models\AbsenDosen;
use App\Models\AbsenStaff;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AbsenStaffExport implements FromCollection, WithMapping, WithHeadings
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
        return AbsenStaff::whereMonth('tanggal', $this->bulan)->whereYear('tanggal', date('Y'))->get();
    }

    public function map($absen): array
    {
        $hadir = '';
        if ($absen->hadir == 1) $hadir = 'Hadir';
        else $hadir = 'Tidak Hadir';
        return [
            $absen->dosen->nama,
            $absen->dosen->nip,
            $absen->tanggal,
            $hadir
        ];
    }

    public function headings(): array
    {
        return [
            [
                'NIP',
                'NAMA',
                'Tanggal',
                'Hadir',
            ],
        ];
    }
}
