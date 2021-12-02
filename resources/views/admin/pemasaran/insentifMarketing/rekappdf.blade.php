<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insentif Marketing</title>

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .table {
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
            margin: 0 auto;
        }

        /* table {
            margin: 0 auto;
        } */

        .table td,
        .table th {
            padding: 12px;
        }

        /* .table th {
            padding-top: 12px;
            padding-bottom: 12px;
        } */

        .text-center {
            text-align: center
        }

        .new-page {
            page-break-before: always;
        }

        .container {
            padding-top: 5px;
        }

        .bio {
            margin-top: 30px;
            padding-left: 25px;
        }

        .bio>* {
            font-size: 18px;
        }

        .bio th {
            width: 130px;
            text-align: left;
        }

        .table th {
            min-width: 300px;
            text-align: left;
        }

        .m-0 {
            margin: 0;
        }
    </style>


</head>

<body>
    <div class="container">
        <h1 class="text-center m-0">Rekap Insentif Marketing</h1>
        <h3 class="text-center m-0">Bulan {{ date('F', mktime(0, 0, 0, $data[0]->bulan, 10)) }}</h3>
        @foreach ($data as $gaji)
        <table class="bio">
            <tr>
                <th>{{ $gaji->pegawai->nama }}</th>
                <th>{{ $gaji->pegawai->nip }}</th>
                {{-- <th>{{ $gaji->pegawai->email }}</th> --}}
            </tr>
        </table>
        <hr width="50%" align="left">
        <table class="table">
            <tr>
                <th>Daftar Regular</th>
                <td>{{ $gaji->total_daftar_regular }}</td>
                <td>x</td>
                <td>Rp {{ number_format($gaji->daftar_regular ,2,",",".") }}</td>
                <td>Rp {{ number_format($gaji->total_daftar_regular * $gaji->daftar_regular ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Daftar Double Degree Internasional</th>
                <td>{{ $gaji->total_daftar_dd_inter }}</td>
                <td>x</td>
                <td>Rp {{ number_format($gaji->daftar_dd_inter ,2,",",".") }}</td>
                <td>Rp {{ number_format($gaji->total_daftar_dd_inter * $gaji->daftar_dd_inter ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Daftar Double Degree Nasional</th>
                <td>{{ $gaji->total_daftar_dd_nasional }}</td>
                <td>x</td>
                <td>Rp {{ number_format($gaji->daftar_dd_nasional ,2,",",".") }}</td>
                <td>Rp {{ number_format($gaji->total_daftar_dd_nasional * $gaji->daftar_dd_nasional ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Registrasi Regular</th>
                <td>{{ $gaji->total_registrasi_regular }}</td>
                <td>x</td>
                <td>Rp {{ number_format($gaji->registrasi_regular ,2,",",".") }}</td>
                <td>Rp {{ number_format($gaji->total_registrasi_regular * $gaji->registrasi_regular ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Registrasi Bisnis</th>
                <td>{{ $gaji->total_registrasi_bisnis }}</td>
                <td>x</td>
                <td>Rp {{ number_format($gaji->registrasi_bisnis ,2,",",".") }}</td>
                <td>Rp {{ number_format($gaji->total_registrasi_bisnis * $gaji->registrasi_bisnis ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Registrasi Double Degree International</th>
                <td>{{ $gaji->total_registrasi_dd_inter }}</td>
                <td>x</td>
                <td>Rp {{ number_format($gaji->registrasi_dd_inter ,2,",",".") }}</td>
                <td>Rp {{ number_format($gaji->total_registrasi_dd_inter * $gaji->registrasi_dd_inter ,2,",",".") }}
                </td>
            </tr>
            <tr>
                <th>Registrasi Double Degree Nasional</th>
                <td>{{ $gaji->total_registrasi_dd_nasional }}</td>
                <td>x</td>
                <td>Rp {{ number_format($gaji->registrasi_dd_nasional ,2,",",".") }}</td>
                <td>Rp {{ number_format($gaji->total_registrasi_dd_nasional * $gaji->registrasi_dd_nasional ,2,",",".")
                    }}</td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <th>Wawancara</th>
                <td>{{ $gaji->total_wawancara }}</td>
                <td>x</td>
                <td>Rp {{ number_format($gaji->wawancara ,2,",",".") }}</td>
                <td>Rp {{ number_format($gaji->total_wawancara * $gaji->wawancara ,2,",",".") }}</td>
            </tr>
            <tr>
                <th></th>
                <td></td>
                <td></td>
                <th style="background-color: #dddddd" class="text-center">Total</th>
                <td style="background-color: #dddddd">Rp {{ number_format($gaji->jumlah ,2,",",".") }}</td>
            </tr>
        </table>
        {{-- <div class="new-page"></div> --}}
        @endforeach
    </div>
</body>

</html>