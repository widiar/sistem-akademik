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
            margin-top: 10px;
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
        <h1 class="text-center m-0">Slip Gaji Staff</h1>
        <h3 class="text-center m-0">Bulan {{ date('F', mktime(0, 0, 0, $gaji->bulan, 10)) }}</h3>
        <table class="bio">
            <tr>
                <th>NIP</th>
                <td>{{ $pegawai->nip }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $pegawai->nama }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $pegawai->email }}</td>
            </tr>
        </table>
        <hr>
        <table class="table">
            <tr>
                <th>Gaji Pokok </th>
                <td>Rp {{ number_format($gaji->gaji_pokok ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Uang Lembur</th>
                <td>Rp {{ number_format($gaji->lembur ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Uang Makan dan Transport</th>
                <td>Rp {{ number_format($gaji->absen * $gaji->makan ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Uang Jabatan</th>
                <td>Rp {{ number_format($gaji->jabatan ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Uang Keahlian</th>
                <td>Rp {{ number_format($gaji->keahlian ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Uang Pulsa</th>
                <td>Rp {{ number_format($gaji->pulsa ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Uang Tol / Bensin</th>
                <td>Rp {{ number_format($gaji->tol ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Kekurangan Gaji</th>
                <td>Rp {{ number_format($gaji->kurang_gaji ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Reward</th>
                <td>Rp {{ number_format($gaji->reward ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Tunjangan Hari Raya</th>
                <td>Rp {{ number_format($gaji->thr ,2,",",".") }}</td>
            </tr>
            <tr style="border-bottom: 1px solid black">
                <th>Insentif Marketing</th>
                <td>Rp {{ number_format($gaji->insentif_marketing ,2,",",".") }}</td>
            </tr>
            <tr style="border-bottom: 1px solid black">
                <th style="font-size: 18px">Gaji Kotor</th>
                <td style="font-size: 18px">Rp {{ number_format($gaji->gaji_kotor ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>BPJS Kesehatan</th>
                <td>Rp {{ number_format($gaji->bpjs_kesehatan ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>BPJS Ketenagakerjaan</th>
                <td>Rp {{ number_format($gaji->bpjs_kerja ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Izin / Sakit</th>
                <td>Rp {{ number_format($gaji->izin ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Telat / Short Time / No Finger</th>
                <td>Rp {{ number_format($gaji->telat ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>I/S/A Non alphaeransi</th>
                <td>Rp {{ number_format($gaji->alpha ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Sanksi SP</th>
                <td>Rp {{ number_format($gaji->sanksi ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Kasbon</th>
                <td>Rp {{ number_format($gaji->kasbon ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Uang Makan Non Dinas</th>
                <td>Rp {{ number_format($gaji->makanNonDinas ,2,",",".") }}</td>
            </tr>
            <tr style="border-bottom: 1px solid black">
                <th>Potongan Lain-Lain</th>
                <td>Rp {{ number_format($gaji->potonganLain ,2,",",".") }}</td>
            </tr>
            <tr style="border-bottom: 1px solid black">
                <th style="font-size: 18px">Total Potongan</th>
                <td style="font-size: 18px">Rp {{ number_format($gaji->total_potongan ,2,",",".") }}</td>
            </tr>
            <tr>
                <th style="font-size: 22px">Gaji Diterima</th>
                <td style="font-size: 22px">Rp {{ number_format($gaji->gaji_bersih ,2,",",".") }}</td>
            </tr>
        </table>
    </div>
</body>

</html>