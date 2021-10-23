<?php

namespace App\Exports;

use App\Models\Pegawai;
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
        $bulan = $this->bulan;
        return Pegawai::with(['absenDosen' => function ($q) use ($bulan) {
            $q->whereMonth('tanggal', $bulan)->whereYear('tanggal', date('Y'))->where('hadir', 1);
        }])->where('is_dosen', 1)->get();
    }

    public function map($data): array
    {
        return [
            $data->nip,
            $data->nama,
            $data->absenDosen->count(),
        ];
    }

    public function headings(): array
    {
        return [
            [
                'NIP',
                'NAMA',
                'Total Kehadiran',
            ],
        ];
    }
}
