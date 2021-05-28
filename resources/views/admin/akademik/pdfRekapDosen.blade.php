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
                <th rowspan="2" style="vertical-align: middle">NIP</th>
                <th rowspan="2" style="vertical-align: middle">Nama</th>
                <th rowspan="2" style="vertical-align: middle">Kategori</th>
                <th colspan="2">SKS Dosen</th>
                <th colspan="2">Jumlah Pembimbing</th>
                <th colspan="2">Jumlah Penguji</th>
                <th colspan="2">Jumlah Koordinator</th>
                <th colspan="2">Jumlah Wali</th>
                <th rowspan="2" style="vertical-align: middle">Tahun Ajaran</th>
            </tr>
            <tr>
                <th>Ganjil</th>
                <th>Genap</th>
                <th>Ganjil</th>
                <th>Genap</th>
                <th>Ganjil</th>
                <th>Genap</th>
                <th>Ganjil</th>
                <th>Genap</th>
                <th>Ganjil</th>
                <th>Genap</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dosen as $d)
            @php
            $sks = $d->sks()->where('tahun_ajaran', $tahunAjaran)->first();
            $pembimbing = $d->pembimbing()->where('tahun_ajaran', $tahunAjaran)->first();
            $penguji = $d->penguji()->where('tahun_ajaran', $tahunAjaran)->first();
            $koordinator = $d->koordinator()->where('tahun_ajaran', $tahunAjaran)->first();
            $wali = $d->wali()->where('tahun_ajaran', $tahunAjaran)->first();
            @endphp
            <tr>
                <td>{{ $d->nip }}</td>
                <td>{{ $d->nama }}</td>
                <td>
                    @foreach ($d->kategori as $k)
                    {{ $k->kategori }} ,
                    @endforeach
                </td>
                <td>{{ ($sks) ? $sks->semester_ganjil : '' }}</td>
                <td>{{ ($sks) ? $sks->semester_genap : '' }}</td>
                <td>{{ ($pembimbing) ? $pembimbing->semester_ganjil : '' }}</td>
                <td>{{ ($pembimbing) ? $pembimbing->semester_genap : '' }}</td>
                <td>{{ ($penguji) ? $penguji->semester_ganjil : '' }}</td>
                <td>{{ ($penguji) ? $penguji->semester_genap : '' }}</td>
                <td>{{ ($koordinator) ? $koordinator->semester_ganjil : '' }}</td>
                <td>{{ ($koordinator) ? $koordinator->semester_genap : '' }}</td>
                <td>{{ ($wali) ? $wali->semester_ganjil : '' }}</td>
                <td>{{ ($wali) ? $wali->semester_genap : '' }}</td>
                <td>{{ $tahunAjaran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>