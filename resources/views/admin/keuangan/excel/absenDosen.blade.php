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