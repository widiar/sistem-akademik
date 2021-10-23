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
    </style>
</head>

<body>
    <h3 class="text-center">Hasil Rekap Dosen</h3>
    <table class="table">
        <thead class="text-center">
            <tr>
                <th rowspan="3" style="vertical-align: middle">NIP</th>
                <th rowspan="3" style="vertical-align: middle">Nama</th>
                <th rowspan="3" style="vertical-align: middle">Kategori</th>
                <th colspan="4">Pembimbing TA</th>
                <th colspan="4">Pembimbing Skripsi</th>
                <th colspan="2">Koordinator</th>
                <th colspan="2">Wali</th>
                <th colspan="2">Kerja Praktek</th>
                <th rowspan="3" style="vertical-align: middle">Tahun Ajaran</th>
            </tr>
            <tr>
                <th colspan="2">Ganjil</th>
                <th colspan="2">Genap</th>
                <th colspan="2">Ganjil</th>
                <th colspan="2">Genap</th>
                <th rowspan="2">Ganjil</th>
                <th rowspan="2">Genap</th>
                <th rowspan="2">Ganjil</th>
                <th rowspan="2">Genap</th>
                <th rowspan="2">Ganjil</th>
                <th rowspan="2">Genap</th>
            </tr>
            <tr>
                <th>TA 1</th>
                <th>TA 2</th>
                <th>TA 1</th>
                <th>TA 2</th>
                <th>Skripsi 1</th>
                <th>Skripsi 2</th>
                <th>Skripsi 1</th>
                <th>Skripsi 2</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dosen as $pegawai)
            @php
            $ta = $pegawai->dosen()->where('kategori_id', 1)->wherePivot('tahun_ajaran', tahunAjaran())->first();
            $skripsi = $pegawai->dosen()->where('kategori_id', 2)->wherePivot('tahun_ajaran', tahunAjaran())->first();
            $penguji = $pegawai->dosen()->where('kategori_id', 3)->wherePivot('tahun_ajaran', tahunAjaran())->first();
            $koor = $pegawai->dosen()->where('kategori_id', 4)->wherePivot('tahun_ajaran', tahunAjaran())->first();
            $wali = $pegawai->dosen()->where('kategori_id', 5)->wherePivot('tahun_ajaran', tahunAjaran())->first();
            $kp = $pegawai->dosen()->where('kategori_id', 6)->wherePivot('tahun_ajaran', tahunAjaran())->first();
            @endphp
            <tr>
                <td>{{ $pegawai->nip }}</td>
                <td>{{ $pegawai->nama }}</td>
                <td>
                    @foreach ($pegawai->dosen as $k)
                    {{ $k->kategori }} ,
                    @endforeach
                </td>
                <td>{{ (@$ta) ? json_decode($ta->pivot->semester_ganjil)->ta1 : '-' }}</td>
                <td>{{ (@$ta) ? json_decode($ta->pivot->semester_ganjil)->ta2 : '-' }}</td>
                <td>{{ (@$ta) ? json_decode($ta->pivot->semester_genap)->ta1 : '-' }}</td>
                <td>{{ (@$ta) ? json_decode($ta->pivot->semester_genap)->ta2 : '-' }}</td>
                <td>{{ (@$skripsi) ? json_decode($skripsi->pivot->semester_ganjil)->skripsi1 : '-' }}</td>
                <td>{{ (@$skripsi) ? json_decode($skripsi->pivot->semester_ganjil)->skripsi2 : '-' }}</td>
                <td>{{ (@$skripsi) ? json_decode($skripsi->pivot->semester_genap)->skripsi1 : '-' }}</td>
                <td>{{ (@$skripsi) ? json_decode($skripsi->pivot->semester_genap)->skripsi2 : '-' }}</td>
                <td>{{ (@$koor) ? json_decode($koor->pivot->semester_ganjil)->ganjil : '-' }}</td>
                <td>{{ (@$koor) ? json_decode($koor->pivot->semester_genap)->genap : '-' }}</td>
                <td>{{ (@$wali) ? json_decode($wali->pivot->semester_ganjil)->ganjil : '-' }}</td>
                <td>{{ (@$wali) ? json_decode($wali->pivot->semester_genap)->genap : '-' }}</td>
                <td>{{ (@$kp) ? json_decode($kp->pivot->semester_ganjil)->ganjil : '-' }}</td>
                <td>{{ (@$kp) ? json_decode($kp->pivot->semester_genap)->genap : '-' }}</td>
                <td>{{ $tahunAjaran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>