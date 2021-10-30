<?php

namespace App\Exports;

use App\Models\Pegawai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AbsenDosenExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $bulan;
    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function view(): View
    {
        $month = $this->bulan;
        $regular = Pegawai::with(['absenDosen' => function ($q) use ($month) {
            $q->whereMonth('tanggal', $month)->whereYear('tanggal', date('Y'))->where('hadir', 1)->where('kategori', 'Regular');
        }])->where('is_dosen', 1)->get();
        $karyawan = Pegawai::with(['absenDosen' => function ($q) use ($month) {
            $q->whereMonth('tanggal', $month)->whereYear('tanggal', date('Y'))->where('hadir', 1)->where('kategori', 'Karyawan');
        }])->where('is_dosen', 1)->get();
        $eksekutif = Pegawai::with(['absenDosen' => function ($q) use ($month) {
            $q->whereMonth('tanggal', $month)->whereYear('tanggal', date('Y'))->where('hadir', 1)->where('kategori', 'Eksekutif / Semester Pendek');
        }])->where('is_dosen', 1)->get();
        $inter = Pegawai::with(['absenDosen' => function ($q) use ($month) {
            $q->whereMonth('tanggal', $month)->whereYear('tanggal', date('Y'))->where('hadir', 1)->where('kategori', 'International Teori');
        }])->where('is_dosen', 1)->get();
        return view('admin.keuangan.excel.absenDosen', compact(
            'regular',
            'month',
            'karyawan',
            'eksekutif',
            'inter'
        ));
    }

    // public function collection()
    // {
    //     $bulan = $this->bulan;
    //     return Pegawai::with(['absenDosen' => function ($q) use ($bulan) {
    //         $q->whereMonth('tanggal', $bulan)->whereYear('tanggal', date('Y'))->where('hadir', 1);
    //     }])->where('is_dosen', 1)->get();
    // }

    // public function map($data): array
    // {
    //     return [
    //         $data->nip,
    //         $data->nama,
    //         $data->absenDosen->count(),
    //     ];
    // }

    // public function headings(): array
    // {
    //     return [
    //         [
    //             'NIP',
    //             'NAMA',
    //             'Total Kehadiran',
    //         ],
    //     ];
    // }
}
