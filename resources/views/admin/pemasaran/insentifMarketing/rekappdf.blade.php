<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slip Gaji Staff</title>

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .table {
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
            /* margin: 0 auto; */
        }

        table {
            margin: 0 auto;
        }

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
        <hr width="50%">
        <table class="table">
            <tr>
                <th>Persenter Daftar</th>
                <td>Rp {{ number_format($gaji->total_daftar * $gaji->daftar ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Registrasi Regular</th>
                <td>Rp {{ number_format($gaji->total_regular * $gaji->regular ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Registrasi Karyawan</th>
                <td>Rp {{ number_format($gaji->total_karyawan * $gaji->karyawan ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Registrasi International</th>
                <td>Rp {{ number_format($gaji->total_international * $gaji->international ,2,",",".") }}</td>
            </tr>
            <tr style="border-bottom: 1px solid black;">
                <th>Presenter Wawancara</th>
                <td>Rp {{ number_format($gaji->total_wawancara * $gaji->wawancara ,2,",",".") }}</td>
            </tr>
            <tr style="background-color: #dddddd">
                <th>Total</th>
                <td>Rp {{ number_format($gaji->jumlah ,2,",",".") }}</td>
            </tr>
        </table>
        {{-- <div class="new-page"></div> --}}
        @endforeach
    </div>
</body>

</html>