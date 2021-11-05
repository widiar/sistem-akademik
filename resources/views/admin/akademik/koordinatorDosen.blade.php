@extends('admin.template.dashboard')

@section('title', 'Dosen')

@section('main-content')
@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> BERHASIL!</h5>
    {{session('success')}}
</div>
@elseif(session('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> GAGAL!</h5>
    {{session('error')}}
</div>
@endif
<div class="tanggal m-3 row">
    <div class="col-md-6 col-xs-12">
        <label for="">Pilih Semester</label>
        <select class="form-control bulan" name="semester" id="semester">
            @foreach ($tahunAjaran as $semester)
            <option value="{{ $semester['id'] }}">{{ $semester['text'] }}</option>
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
                @if (!is_null($dosen))
                @foreach ($dosen as $ban)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $ban->nip }}</td>
                    <td>{{ $ban->nama }}</td>
                    <td class="text-center">
                        <button class="btn btn-edit btn-sm btn-primary" data-id="{{ $ban->id }}"><i
                                class="fas fa-edit"></i></button>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('script')
<script>
    $('.bulan').select2({
        theme: "bootstrap"
    })
    let url = `{{ route('admin.dosen.koordinator.edit', ['semester' => '#bulan', 'pegawai' => '#id']) }}`
    let smt = $('#semester').val()
    $("#semester").change(() => {
        smt = $("#semester").val()
    })
    $("body").on("click", ".btn-edit", function(){
        let id = $(this).data("id")
        let urlEdit = url.replace("#bulan", smt)
        urlEdit = urlEdit.replace("#id", id)
        window.location.href = urlEdit
    })
</script>
@endsection