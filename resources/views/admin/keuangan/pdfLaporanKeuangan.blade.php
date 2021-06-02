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
    <h3 class="text-center">Laporan Gaji Bulan {{ date('F', mktime(0, 0, 0, $bulan, 10)) }} </h3>
    <table class="table">
        <thead class="text-center">
            <tr>
                <th style="vertical-align: middle">NIP</th>
                <th style="vertical-align: middle">Nama</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan</th>
                <th>Bonus</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataDosen as $d)
            @php
            $pokok = 0;
            $tunjangan = 0;
            $bonus = 0;
            if($d->is_dosen) $pokok += $dosen->pokok;
            if($d->is_staff) $pokok += $staff->pokok;
            if($d->is_marketing) $pokok += $marketing->pokok;

            if($d->is_dosen) $tunjangan += $dosen->tunjangan;
            if($d->is_staff) $tunjangan += $staff->tunjangan;
            if($d->is_marketing) $tunjangan += $marketing->tunjangan;

            if($d->is_dosen) $bonus += $dosen->bonus;
            if($d->is_staff) $bonus += $staff->bonus;
            if($d->is_marketing) $bonus += $marketing->bonus;
            @endphp
            <tr>
                <td>{{ $d->nip }}</td>
                <td> {{ $d->nama }} </td>
                <td>Rp. {{ number_format($pokok,2,',','.') }}</td>
                <td>Rp. {{ number_format($tunjangan,2,',','.') }}</td>
                <td>Rp. {{ number_format($bonus,2,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>