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
    <h3 class="text-center">Hasil Rekap Absensi Dosen</h3>
    <table class="table">
        <thead class="text-center">
            <tr>
                <th style="vertical-align: middle">NIP</th>
                <th style="vertical-align: middle">Nama</th>
                <th>Januari</th>
                <th>Februari</th>
                <th>Maret</th>
                <th>April</th>
                <th>Mei</th>
                <th>Juni</th>
                <th>Juli</th>
                <th>Agustus</th>
                <th>September</th>
                <th>Oktober</th>
                <th>November</th>
                <th>Desember</th>
                <th>Semester Ganjil</th>
                <th>Semester Genap</th>
                <th style="vertical-align: middle">Tahun Ajaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absen as $data)
            @if($data->dosen->is_staff)
            <tr>
                <td>{{ $data->dosen->nip }}</td>
                <td>{{ $data->dosen->nama }}</td>
                <td>
                    @foreach ($data->dosen->absen as $b)
                    @if ($b->bulan == 1)
                    {{ $b->absen }}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($data->dosen->absen as $b)
                    @if ($b->bulan == 2)
                    {{ $b->absen }}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($data->dosen->absen as $b)
                    @if ($b->bulan == 3)
                    {{ $b->absen }}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($data->dosen->absen as $b)
                    @if ($b->bulan == 4)
                    {{ $b->absen }}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($data->dosen->absen as $b)
                    @if ($b->bulan == 5)
                    {{ $b->absen }}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($data->dosen->absen as $b)
                    @if ($b->bulan == 6)
                    {{ $b->absen }}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($data->dosen->absen as $b)
                    @if ($b->bulan == 7)
                    {{ $b->absen }}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($data->dosen->absen as $b)
                    @if ($b->bulan == 8)
                    {{ $b->absen }}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($data->dosen->absen as $b)
                    @if ($b->bulan == 9)
                    {{ $b->absen }}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($data->dosen->absen as $b)
                    @if ($b->bulan == 10)
                    {{ $b->absen }}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($data->dosen->absen as $b)
                    @if ($b->bulan == 11)
                    {{ $b->absen }}
                    @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($data->dosen->absen as $b)
                    @if ($b->bulan == 12)
                    {{ $b->absen }}
                    @endif
                    @endforeach
                </td>
                <td>
                    @php
                    $ganjil =
                    $data->dosen->absen()->where('tahun_ajaran', $tahunAjaran)->where('bulan', '>', 6)->sum('absen');
                    $genap =
                    $data->dosen->absen()->where('tahun_ajaran', $tahunAjaran)->where('bulan', '<=', 6)->sum('absen');
                        $sks = $data->dosen->sks()->where('tahun_ajaran', $tahunAjaran)->first();
                        $tganjil = -1;
                        $tgenap = -1;
                        if ($sks) {
                        if ($sks->semester_ganjil) $tganjil = $sks->semester_ganjil * 24;
                        if ($sks->semester_genap) $tgenap = $sks->semester_genap * 24;
                        }
                        $pGenap = ($genap / $tgenap) * 100;
                        $pGanjil = ($ganjil / $tganjil) * 100;
                        @endphp
                        {{ ($pGanjil <= 0) ? '' : number_format($pGanjil, 2, ',', '.') . "%" }}
                </td>
                <td>{{ ($pGenap <= 0) ? '' : number_format($pGenap, 2, ',', '.') . "%" }}</td>
                <td>{{ $tahunAjaran }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</body>

</html>