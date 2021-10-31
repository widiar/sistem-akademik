<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <style>
        .table {
            border: 1px solid black;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
            margin: 0 auto;
        }

        .table td,
        .table th {
            border: 1px solid black;
            padding: 8px;
        }

        .table th {
            padding-top: 12px;
            padding-bottom: 12px;
        }

        .text-center {
            text-align: center
        }

        tbody td {
            text-align: center
        }
    </style>
</head>

<body>
    <h3 class="text-center">Rekap Dosen {{ date('F', mktime(0, 0, 0, $bulan, 10)) }} {{ $tahun }}</h3>
    <table class="table">
        <thead class="text-center">
            <tr>
                <th rowspan="3" style="vertical-align: middle">NIP</th>
                <th rowspan="3" style="vertical-align: middle">Nama</th>
                <th colspan="4">Pembimbing TA</th>
                <th colspan="4">Pembimbing Skripsi</th>
                <th colspan="4">Penguji</th>
                <th rowspan="3">Koordinator</th>
                <th rowspan="3">Dosen Wali</th>
                <th rowspan="3">Kerja Praktek</th>
            </tr>
            <tr>
                <th colspan="2">TA 1</th>
                <th colspan="2">TA 2</th>
                <th colspan="2">Skripsi 1</th>
                <th colspan="2">Skripsi 2</th>
                <th rowspan="2" style="max-width: 75px">Seminar Skripsi</th>
                <th rowspan="2" style="max-width: 75px">Seminar Terbuka</th>
                <th rowspan="2" style="max-width: 75px">Proposal TA</th>
                <th rowspan="2" style="max-width: 75px">Tugas Akhir</th>
            </tr>
            <tr>
                <th colspan="2">P 1</th>
                <th>P 1</th>
                <th>P 2</th>
                <th colspan="2">P 1</th>
                <th>P 1</th>
                <th>P 2</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dosen as $pegawai)
            <tr>
                <td>{{ $pegawai->nip }}</td>
                <td>{{ $pegawai->nama }}</td>
                <td colspan="2">
                    {{ (@$pegawai->dosen[0]->tugas_akhir_1) ? $pegawai->dosen[0]->tugas_akhir_1 : '-' }}
                </td>
                <td>
                    {{ (@$pegawai->dosen[0]->tugas_akhir_2_pembimbing_1) ?
                    $pegawai->dosen[0]->tugas_akhir_2_pembimbing_1 : '-' }}
                </td>
                <td>{{ (@$pegawai->dosen[0]->tugas_akhir_2_pembimbing_2) ?
                    $pegawai->dosen[0]->tugas_akhir_2_pembimbing_2 :
                    '-' }}</td>
                <td colspan="2">{{ (@$pegawai->dosen[0]->skripsi_1) ? $pegawai->dosen[0]->skripsi_1 : '-' }}</td>
                <td>{{ (@$pegawai->dosen[0]->skripsi_2_pembimbing_1) ? $pegawai->dosen[0]->skripsi_2_pembimbing_1 : '-'
                    }}
                </td>
                <td>{{ (@$pegawai->dosen[0]->skripsi_2_pembimbing_2) ? $pegawai->dosen[0]->skripsi_2_pembimbing_2 : '-'
                    }}
                </td>
                <td>{{ (@$pegawai->dosen[0]->penguji_seminar_skripsi) ? $pegawai->dosen[0]->penguji_seminar_skripsi :
                    '-' }}
                </td>
                <td>{{ (@$pegawai->dosen[0]->penguji_seminar_terbuka) ? $pegawai->dosen[0]->penguji_seminar_terbuka :
                    '-' }}
                </td>
                <td>{{ (@$pegawai->dosen[0]->penguji_proposal_TA) ? $pegawai->dosen[0]->penguji_proposal_TA : '-' }}
                </td>
                <td>{{ (@$pegawai->dosen[0]->penguji_tugas_akhir) ? $pegawai->dosen[0]->penguji_tugas_akhir : '-' }}
                </td>
                <td>{{ (@$pegawai->dosen[0]->koordinator) ? $pegawai->dosen[0]->koordinator : '-' }}</td>
                <td>{{ (@$pegawai->dosen[0]->wali) ? $pegawai->dosen[0]->wali : '-' }}</td>
                <td>{{ (@$pegawai->dosen[0]->kerja_praktek) ? $pegawai->dosen[0]->kerja_praktek : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>