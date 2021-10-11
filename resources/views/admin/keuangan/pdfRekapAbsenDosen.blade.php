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
    <h3 class="text-center">Hasil Rekap Absensi Dosen</h3>
    <table class="table">
        <thead class="text-center">
            <tr>
                <th style="vertical-align: middle">NIP</th>
                <th style="vertical-align: middle">Nama</th>
                <th style="vertical-align: middle">Matakuliah</th>
                <th>Tanggal</th>
                <th>Hadir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absen as $data)
            <tr>
                <td>{{ $data->dosen->nip }}</td>
                <td>{{ $data->dosen->nama }}</td>
                <td>{{ $data->matkul->nama }}</td>
                <td>{{ $data->tanggal }}</td>
                @if ($data->hadir == 1)
                <td>&#10003;</td>
                @else
                <td>&#8855;</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>