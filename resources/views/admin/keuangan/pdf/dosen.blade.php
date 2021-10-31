<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slip Gaji Dosen</title>

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
            padding: 8px;
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
            min-width: 380px;
            text-align: left;
        }

        .m-0 {
            margin: 0;
        }
    </style>


</head>

<body>
    <div class="container">
        <h1 class="text-center m-0">Slip Gaji Dosen</h1>
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
                <th>Uang Mengajar</th>
                <td>Rp {{ number_format($gaji->mengajar ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Uang Transport</th>
                <td>Rp {{ number_format($gaji->transport ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Dosen Wali</th>
                <td>Rp {{ number_format($gaji->waliTotal * $gaji->wali ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Honor Mengajar Regular</th>
                <td>Rp {{ number_format($gaji->absen * $gaji->regular ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Honor Mengajar Karyawan</th>
                <td>Rp {{ number_format($gaji->karyawanTotal * $gaji->karyawan ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Honor Mengajar Eksekutif / Semester Pendek</th>
                <td>Rp {{ number_format($gaji->eksekutifTotal * $gaji->eksekutif ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Honor Mengajar International Teori</th>
                <td>Rp {{ number_format($gaji->interTeoriTotal * $gaji->interTeori ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Honor Mengajar International Praktek</th>
                <td>Rp {{ number_format($gaji->interPraktekTotal * $gaji->interPraktek ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Honor Mengajar Kerja Praktek</th>
                <td>Rp {{ number_format($gaji->kerjaPraktekTotal * $gaji->kerjaPraktek ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Skripsi I</th>
                <td>Rp {{ number_format($gaji->skripsi1Total * $gaji->skripsi1 ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Skripsi II</th>
                <td>Rp {{ number_format(($gaji->skripsi2Pembimbing1Total * $gaji->skripsi2Pembimbing1) +
                    ($gaji->skripsi2Pembimbing2Total * $gaji->skripsi2Pembimbing2) ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Tugas Akhir I</th>
                <td>Rp {{ number_format($gaji->ta1Total * $gaji->ta1 ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Tugas Akhir II</th>
                <td>Rp {{ number_format(($gaji->ta2Pembimbing1Total * $gaji->ta2Pembimbing1) +
                    ($gaji->ta2Pembimbing2Total * $gaji->ta2Pembimbing2) ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Penguji Seminar Skripsi</th>
                <td>Rp {{ number_format($gaji->seminarSkripsiTotal * $gaji->seminarSkripsi ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Penguji Seminar Terbuka</th>
                <td>Rp {{ number_format($gaji->seminarTerbukaTotal * $gaji->seminarTerbuka ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Penguji Proposal Tugas Akhir</th>
                <td>Rp {{ number_format($gaji->proposalTotal * $gaji->proposal ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Koreksi Regular</th>
                <td>Rp {{ number_format($gaji->koreksiRegularTotal * $gaji->koreksiRegular ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Koreksi Karyawan</th>
                <td>Rp {{ number_format($gaji->koreksiKaryawanTotal * $gaji->koreksiKaryawan ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Koreksi International</th>
                <td>Rp {{ number_format($gaji->koreksiInterTotal * $gaji->koreksiInter ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Soal Regular</th>
                <td>Rp {{ number_format($gaji->soalRegularTotal * $gaji->soalRegular ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Soal Karyawan</th>
                <td>Rp {{ number_format($gaji->soalKaryawanTotal * $gaji->soalKaryawan ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Soal International</th>
                <td>Rp {{ number_format($gaji->soalInterTotal * $gaji->soalInter ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Pengawas</th>
                <td>Rp {{ number_format($gaji->pengawasTotal * $gaji->pengawas ,2,",",".") }}</td>
            </tr>
            <tr>
                <th>Lembur Pengawas</th>
                <td>Rp {{ number_format($gaji->lemburPengawasTotal * $gaji->lemburPengawas ,2,",",".") }}</td>
            </tr>
            <tr style="border-bottom: 1px solid black">
                <th>Koordinator</th>
                <td>Rp {{ number_format($gaji->koorTotal * $gaji->koor ,2,",",".") }}</td>
            </tr>
            <tr>
                <th style="font-size: 22px">Gaji Diterima</th>
                <td style="font-size: 22px">Rp {{ number_format($gaji->gajiTotal ,2,",",".") }}</td>
            </tr>
        </table>
    </div>
</body>

</html>