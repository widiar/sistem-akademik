@extends('admin.template.dashboard')

@section('title', 'Rekap Absen Dosen')

@section('main-content')
<div class="mx-3 row">
    <div class="col-sm-12 col-md-6 form-group">
        <label for="bulan">Bulan</label>
        <select name="bulan" class="bulan w-100 form-control" style="width: 100%;">
            @foreach ($bulan as $k)
            <option value="{{ $k->id }}" {{ (date('n')==$k->id) ? 'selected' : '' }}>
                {{ $k->name }}
            </option>
            @endforeach
        </select>
    </div>
</div>
<div class="card shadow mx-3">
    <div class="card-body table-responsive">
        <table id="adminTable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="actionz">
                @php
                $no=0;
                @endphp
                @if (!is_null($data))
                @foreach ($data as $ban)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td class="text-center">
                        {{ $ban->nip }}
                    </td>
                    <td>{{ $ban->nama }}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-primary btn-edit" data-id="{{ $ban->id }}"><i
                                class="fas fa-eye"></i></button>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="ml-3">

    </div>
</div>


@endsection

@section('script')
<script>
    let bulan = `{{ date('n') }}`;
    let url = `{{ route('admin.penggajian.staff.detail', ['bulan' => '#bulan', 'id' => '#id']) }}`
    $('.bulan').select2({
        theme: "bootstrap"
    });
    $(".bulan").change(() => {
        bulan = $(".bulan").val()
    })
    $(".btn-edit").click(function() {
        let id = $(this).data("id")
        let urlEdit = url.replace("#bulan", bulan)
        urlEdit = urlEdit.replace("#id", id)
        window.location.href = urlEdit
    })
</script>
@endsection