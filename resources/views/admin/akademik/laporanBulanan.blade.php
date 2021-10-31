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
        <label for="">Pilih Tanggal</label>
        <div class="input-group">
            <input type="text" id="tgl" class="form-control datepicker" value="{{ date('m-Y') }}">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
            </div>
        </div>
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
                    {{-- <th>Kategori</th> --}}
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
                    {{-- <td>
                        @foreach ($ban->dosen as $kat)
                        {{ $kat->kategori . ", " }}
                        @endforeach
                    </td> --}}
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
    let url = `{{ route('admin.dosen.edit', ['bulan' => '#bulan', 'pegawai' => '#id']) }}`
    let bulan = `{{ date('m-Y') }}`
    $("#tgl").change(() => {
        bulan = $("#tgl").val()
    })
    $("body").on("click", ".btn-edit", function(){
        let id = $(this).data("id")
        let urlEdit = url.replace("#bulan", bulan)
        urlEdit = urlEdit.replace("#id", id)
        window.location.href = urlEdit
    })
    $(".datepicker").datepicker({
        format: 'mm-yyyy',
        todayBtn: "linked",
        startView: "months", 
        minViewMode: "months",
        // daysOfWeekDisabled: "0,6",
        autoclose: true,
        endDate: "+0d",
        todayHighlight: true
    });
</script>
@endsection