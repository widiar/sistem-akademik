<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            border-collapse: collapse;
            margin: 0 auto;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .text-medium {
            font-size: 16px;
        }

        .text-large {
            font-size: 20px;
        }

        .bg-grey {
            background-color: #d1d1d1;
        }

        .text-center {
            text-align: center;
        }

        .mw-200 {
            min-width: 250px;
        }
    </style>
</head>

<body>
    <h2 class="text-center">Rekap Absen Dosen {{ date('F', mktime(0, 0, 0, $month, 10)) }} {{ $tahun }}</h2>

    <table>
        @foreach($pegawai as $dosen)
        @php
        $absen = $dosen->absenDosen()->where('hadir', 1)->distinct('kategori')->get();
        $total = 0;
        @endphp
        <tr>
            <th class="text-large text-center">{{ $dosen->nama }}</th>
            <th class="text-large text-center">{{ $dosen->nip }}</th>
        </tr>
        @foreach($absen as $dt)
        <tr>
            <th>{{ $dt->kategori }}</th>
            <th></th>
            <th>SKS</th>
            <th>Pert(X)</th>
            <th>Total</th>
            <th>Jumlah MHS</th>
        </tr>

        @php
        $matkul = absenMatkul($dt->pegawai_id, $dt->kategori, $month, $tahun);
        $no = 0;
        @endphp

        @foreach ($matkul as $matk)
        <tr>
            <td>{{ ++$no }}. {{ $matk->matkul->kode }} {{ $matk->matkul->nama }}</td>
            <td>{{ $matk->matkul->kode_kelas }}</td>
            <td>{{ $matk->matkul->sks }}</td>
            <td>{{ totalPertemuan($dt->pegawai_id, $matk->matkul->id, $dt->kategori, $month, $tahun) }} </td>
            <td>{{ $matk->matkul->sks * totalPertemuan($dt->pegawai_id, $matk->matkul->id, $dt->kategori, $month,
                $tahun) }}</td>
            <td>{{ $matk->matkul->jumlah_mahasiswa }}</td>
            @php
            $total+=$matk->matkul->sks * totalPertemuan($dt->pegawai_id, $matk->matkul->id, $dt->kategori, $month,
            $tahun)
            @endphp
        </tr>
        @endforeach

        @endforeach
        <tr style="margin-bottom: 30px;">
            <th style="border-bottom: 2px solid black;"></th>
            <th style="border-bottom: 2px solid black;"></th>

            <th class="bg-grey" style=" border-bottom: 2px solid black;">Total SKS</th>
            <th class="bg-grey" style="border-bottom: 2px solid black;"></th>
            <th class="bg-grey" style="border-bottom: 2px solid black;">{{ $total }}</th>
            <th style="border-bottom: 2px solid black;"></th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
    </table>

</body>

</html>