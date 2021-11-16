<table class="table">
    <thead class="text-center">
        <tr>
            <th style="vertical-align: middle">NIP</th>
            <th style="vertical-align: middle">Nama</th>
            <th>Cuti</th>
            <th>Sakit</th>
            <th>Izin</th>
            <th>I/S/A/Non Toleransi</th>
            <th>Short Time</th>
            <th>Telat Kurang Dari 30 Menit</th>
            <th>Telat Lebih Dari 30 Menit</th>
            <th>Tidak Finger</th>
            <th>Total Sakit Izin Alpha</th>
        </tr>
    </thead>
    <tbody>
        @php
        $cuti = 0;
        $sakit = 0;
        $izin = 0;
        $alpha = 0;
        $short = 0;
        $telat_kurang = 0;
        $telat_lebih = 0;
        $no_finger = 0;
        $total_SIA = 0;
        @endphp
        @foreach ($absen as $data)
        <tr>
            <td>{{ $data->nip }}</td>
            <td>{{ $data->nama }}</td>
            <td class="text-center">{{ $data->absenStaff[0]->cuti }}</td>
            <td class="text-center">{{ $data->absenStaff[0]->sakit }}</td>
            <td class="text-center">{{ $data->absenStaff[0]->izin }}</td>
            <td class="text-center">{{ $data->absenStaff[0]->alpha }}</td>
            <td class="text-center">{{ $data->absenStaff[0]->short }}</td>
            <td class="text-center">{{ $data->absenStaff[0]->telat_kurang }}</td>
            <td class="text-center">{{ $data->absenStaff[0]->telat_lebih }}</td>
            <td class="text-center">{{ $data->absenStaff[0]->no_finger }}</td>
            <td class="text-center">{{ $data->absenStaff[0]->total_SIA }}</td>
            @php
            $cuti += $data->absenStaff[0]->cuti;
            $sakit += $data->absenStaff[0]->sakit;
            $izin += $data->absenStaff[0]->izin;
            $alpha += $data->absenStaff[0]->alpha;
            $short += $data->absenStaff[0]->short;
            $telat_kurang += $data->absenStaff[0]->telat_kurang;
            $telat_lebih += $data->absenStaff[0]->telat_lebih;
            $no_finger += $data->absenStaff[0]->no_finger;
            $total_SIA += $data->absenStaff[0]->total_SIA;
            @endphp
        </tr>
        @endforeach
        <tr>
            <td colspan="2" class="text-center">Total</td>
            <td class="text-center">{{ $cuti }}</td>
            <td class="text-center">{{ $sakit }}</td>
            <td class="text-center">{{ $izin }}</td>
            <td class="text-center">{{ $alpha }}</td>
            <td class="text-center">{{ $short }}</td>
            <td class="text-center">{{ $telat_kurang }}</td>
            <td class="text-center">{{ $telat_lebih }}</td>
            <td class="text-center">{{ $no_finger }}</td>
            <td class="text-center">{{ $total_SIA }}</td>
        </tr>
    </tbody>
</table>