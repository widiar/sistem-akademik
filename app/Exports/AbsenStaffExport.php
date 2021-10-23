<?php

namespace App\Exports;

use App\Models\AbsenDosen;
use App\Models\AbsenStaff;
use App\Models\Pegawai;
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
        $bulan = $this->bulan;
        return Pegawai::with(['absenStaff' => function ($q) use ($bulan) {
            $q->whereMonth('tanggal', $bulan)->whereYear('tanggal', date('Y'))->where('hadir', 1);
        }])->where('is_staff', 1)->get();
    }

    public function map($data): array
    {
        return [
            $data->nip,
            $data->nama,
            $data->absenStaff->count(),
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
