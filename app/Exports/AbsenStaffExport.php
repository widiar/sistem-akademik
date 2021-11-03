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
    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        $month = $this->bulan;
        $year = $this->tahun;
        $absen = Pegawai::with(['absenStaff' => function ($q) use ($month, $year) {
            $q->whereMonth('tanggal', $month)->whereYear('tanggal', $year);
        }])->where('is_staff', 1)->get();
        $dt = [];
        foreach ($absen as $as) {
            $hadir = 0;
            $izin = -2;
            $telat = 0;
            $alpha = 0;
            foreach ($as->absenStaff as $absenStaff) {
                if ($absenStaff->hadir == 1) $hadir += 1;
                if ($absenStaff->izin == 1) $izin += 1;
                if ($absenStaff->keterangan == 'telat' || $absenStaff->keterangan == 'nofinger' || $absenStaff == 'sethari') $telat += 1;
                if ($absenStaff->keterangan == 'alpha') $alpha += 1;
            }
            $dt[] = [
                'nip' => $as->nip,
                'nama' => $as->nama,
                'hadir' => $hadir,
                'izin' => ($izin > 0) ? $izin : 0,
                'telat' => $telat,
                'alpha' => $alpha,
            ];
        }
        return collect($dt);
    }

    public function map($data): array
    {
        return [
            $data['nip'],
            $data['nama'],
            ($data['hadir'] == 0) ? '0' : $data['hadir'],
            ($data['izin'] == 0) ? '0' : $data['izin'],
            ($data['telat'] == 0) ? '0' : $data['telat'],
            ($data['alpha'] == 0) ? '0' : $data['alpha'],
        ];
    }

    public function headings(): array
    {
        return [
            [
                'NIP',
                'NAMA',
                'Total Hadir',
                'Total Izin',
                'Total Telat',
                'Total Alpha',
            ],
        ];
    }
}
