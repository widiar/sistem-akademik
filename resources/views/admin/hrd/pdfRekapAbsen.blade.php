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
    <h2 class="text-center">Hasil Rekap Absensi Staff Bulan {{ date('F', mktime(0, 0, 0, $month, 10)) }} {{ $tahun }}
    </h2>
    <table class="table">
        <thead class="text-center">
            <tr>
                <th style="vertical-align: middle">NIP</th>
                <th style="vertical-align: middle">Nama</th>
                <th>Total Hadir</th>
                <th>Total Izin/Sakit</th>
                <th>Total Telat</th>
                <th>Total Alpha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $absen)
            <tr>
                <td>{{ $absen->nip }}</td>
                <td>{{ $absen->nama }}</td>
                <td class="text-center">{{ $absen->hadir }}</td>
                <td class="text-center">{{ $absen->izin }}</td>
                <td class="text-center">{{ $absen->telat }}</td>
                <td class="text-center">{{ $absen->alpha }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>