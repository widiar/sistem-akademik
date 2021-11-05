<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            border-collapse: collapse;
            margin: 0 auto;
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
            font-size: 22px;
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
    <h3 class="text-center">Rekap Dosen {{ date('F', mktime(0, 0, 0, $bulan, 10)) }} {{ $tahun }}</h3>

    <table>

        @foreach($dosen as $data)
        <tr>
            <th class="text-large text-center mw-200">{{ $data->nama }}</th>
            <th class="text-large text-center mw-200">{{ $data->nip }}</th>
        </tr>
        @if($data->dosen->count() > 0)

        @if($data->dosen[0]->tugas_akhir_2_pembimbing_1 > 0)
        <tr class="bg-grey">
            <th class="text-medium">Pembimbing I Tugas Akhir</th>
            <th class="text-center">{{ $data->dosen[0]->tugas_akhir_2_pembimbing_1 }}</th>
        </tr>
        <tr>
            <th>Nama Mahasiswa</th>
        </tr>
        @php
        $no = 0;
        @endphp
        @foreach(json_decode($data->dosen[0]->tugas_akhir_2_pembimbing_1_nama) as $nama)
        <tr>
            <td>{{ ++$no }}. {{ $nama }}</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
        </tr>
        @endif
        @if($data->dosen[0]->tugas_akhir_2_pembimbing_2 > 0)
        <tr class="bg-grey">
            <th class="text-medium">Pembimbing II Tugas Akhir</th>
            <th class="text-center">{{ $data->dosen[0]->tugas_akhir_2_pembimbing_2 }}</th>
        </tr>
        <tr>
            <th>Nama Mahasiswa</th>
        </tr>
        @php
        $no = 0;
        @endphp
        @foreach(json_decode($data->dosen[0]->tugas_akhir_2_pembimbing_2_nama) as $nama)
        <tr>
            <td>{{ ++$no }}. {{ $nama }}</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
        </tr>
        @endif

        @if($data->dosen[0]->skripsi_2_pembimbing_1 > 0)
        <tr class="bg-grey">
            <th class="text-medium">Pembimbing I Skripsi</th>
            <th class="text-center">{{ $data->dosen[0]->skripsi_2_pembimbing_1 }}</th>
        </tr>
        <tr>
            <th>Nama Mahasiswa</th>
        </tr>
        @php
        $no = 0;
        @endphp
        @foreach(json_decode($data->dosen[0]->skripsi_2_pembimbing_1_nama) as $nama)
        <tr>
            <td>{{ ++$no }}. {{ $nama }}</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
        </tr>
        @endif
        @if($data->dosen[0]->skripsi_2_pembimbing_2 > 0)
        <tr class="bg-grey">
            <th class="text-medium">Pembimbing II Skripsi</th>
            <th class="text-center">{{ $data->dosen[0]->skripsi_2_pembimbing_2 }}</th>
        </tr>
        <tr>
            <th>Nama Mahasiswa</th>
        </tr>
        @php
        $no = 0;
        @endphp
        @foreach(json_decode($data->dosen[0]->skripsi_2_pembimbing_2_nama) as $nama)
        <tr>
            <td>{{ ++$no }}. {{ $nama }}</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
        </tr>
        @endif

        @if($data->dosen[0]->penguji_seminar_skripsi > 0)
        <tr class="bg-grey">
            <th class="text-medium">Penguji Seminar Skripsi</th>
            <th class="text-center">{{ $data->dosen[0]->penguji_seminar_skripsi }}</th>
        </tr>
        <tr>
            <th>Nama Mahasiswa</th>
        </tr>
        @php
        $no = 0;
        @endphp
        @foreach(json_decode($data->dosen[0]->penguji_seminar_skripsi_nama) as $nama)
        <tr>
            <td>{{ ++$no }}. {{ $nama }}</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
        </tr>
        @endif
        @if($data->dosen[0]->penguji_seminar_terbuka > 0)
        <tr class="bg-grey">
            <th class="text-medium">Penguji Seminar Terbuka</th>
            <th class="text-center">{{ $data->dosen[0]->penguji_seminar_terbuka }}</th>
        </tr>
        <tr>
            <th>Nama Mahasiswa</th>
        </tr>
        @php
        $no = 0;
        @endphp
        @foreach(json_decode($data->dosen[0]->penguji_seminar_terbuka_nama) as $nama)
        <tr>
            <td>{{ ++$no }}. {{ $nama }}</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
        </tr>
        @endif

        @if($data->dosen[0]->penguji_proposal_TA > 0)
        <tr class="bg-grey">
            <th class="text-medium">Penguji Proposal Tugas Akhir</th>
            <th class="text-center">{{ $data->dosen[0]->penguji_proposal_TA }}</th>
        </tr>
        <tr>
            <th>Nama Mahasiswa</th>
        </tr>
        @php
        $no = 0;
        @endphp
        @foreach(json_decode($data->dosen[0]->penguji_proposal_TA_nama) as $nama)
        <tr>
            <td>{{ ++$no }}. {{ $nama }}</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
        </tr>
        @endif
        @if($data->dosen[0]->penguji_tugas_akhir > 0)
        <tr class="bg-grey">
            <th class="text-medium">Penguji Tugas Akhir</th>
            <th class="text-center">{{ $data->dosen[0]->penguji_tugas_akhir }}</th>
        </tr>
        <tr>
            <th>Nama Mahasiswa</th>
        </tr>
        @php
        $no = 0;
        @endphp
        @foreach(json_decode($data->dosen[0]->penguji_tugas_akhir_nama) as $nama)
        <tr>
            <td>{{ ++$no }}. {{ $nama }}</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
        </tr>
        @endif

        @if($data->dosen[0]->wali > 0)
        <tr class="bg-grey">
            <th class="text-medium">Dosen Wali</th>
            <th class="text-center">{{ $data->dosen[0]->wali }}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
        @endif
        @if($data->dosen[0]->kerja_praktek > 0)
        <tr class="bg-grey">
            <th class="text-medium">Dosen Kerja Praktek</th>
            <th class="text-center">{{ $data->dosen[0]->kerja_praktek }}</th>
        </tr>
        <tr>
            <td></td>
        </tr>
        @endif

        @endif
        @if($data->koordinator->count() > 0)
        @if($data->koordinator[0]->jumlah > 0)
        <tr class="bg-grey">
            <th class="text-medium">Dosen Koordinator</th>
            <th class="text-center">{{ $data->koordinator[0]->jumlah }}</th>
        </tr>
        <tr>
            <th>Mata Kuliah</th>
        </tr>
        @php
        $no = 0;
        @endphp
        @foreach(json_decode($data->koordinator[0]->matakuliah) as $nama)
        <tr>
            <td>{{ ++$no }}. {{ $nama }}</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
        </tr>
        @endif
        @endif
        @endforeach

    </table>

</body>

</html>