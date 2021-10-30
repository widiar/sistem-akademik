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
    <h3 class="text-center">Hasil Rekap Absensi Dosen Bulan {{ date('F', mktime(0, 0, 0, $month, 10)) }}</h3>
    <table class="table">
        <thead class="text-center">
            <tr>
                <th style="vertical-align: middle">NIP</th>
                <th style="vertical-align: middle">Nama</th>
                <th>Regular</th>
                <th>Karyawan</th>
                <th>Eksekutif / Semester Pendek</th>
                <th>International Teori</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 0;
            @endphp
            @foreach ($regular as $data)
            <tr>
                <td>{{ $data->nip }}</td>
                <td>{{ $data->nama }}</td>
                <td class="text-center">{{ $data->absenDosen->count() }}</td>
                <td class="text-center">{{ $karyawan[$no]->absenDosen->count() }}</td>
                <td class="text-center">{{ $eksekutif[$no]->absenDosen->count() }}</td>
                <td class="text-center">{{ $inter[$no++]->absenDosen->count() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>