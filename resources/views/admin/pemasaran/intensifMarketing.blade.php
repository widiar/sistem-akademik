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
        <label for="">Pilih Bulan</label>
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
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="actionz">
                @php
                $no=0;
                @endphp
                @if (!is_null($pegawai))
                @foreach ($pegawai as $ban)
                @if($ban->staff->count() > 0)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $ban->nip }}</td>
                    <td>{{ $ban->nama }}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-primary intensif-button mx-3" data-dosen="{{ $ban->id }}">
                            <i class="fas fa-file-signature"></i>
                        </button>
                    </td>
                </tr>
                @endif
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('script')
<script>
    let tanggal = `{{ date('m-Y') }}`;
    let url = `{{ route('admin.insentif-marketing.edit', ['tanggal' => '#bulan', 'staff' => '#id']) }}`

    $("#tgl").change(() => {
        tanggal = $("#tgl").val()
    })
    $("body").on("click", ".intensif-button", function(){
        let id = $(this).data("dosen")
        let urlEdit = url.replace("#bulan", tanggal)
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