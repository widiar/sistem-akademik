<?php

namespace App\Exports;

use App\Models\AbsenDosen;
use App\Models\AbsenStaff;
use App\Models\Pegawai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AbsenStaffExport implements FromView
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

    public function view(): View
    {
        $month = $this->bulan;
        $year = $this->tahun;
        $absen = Pegawai::with(['absenStaff' => function ($q) use ($month, $year) {
            $q->where('bulan', $month)->where('tahun', $year);
        }])->where('is_staff', 1)->get();
        return view('admin.hrd.excelRekapAbsen', compact('absen'));
    }
}
