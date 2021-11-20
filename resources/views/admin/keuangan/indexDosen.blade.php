@extends('admin.template.dashboard')

@section('title', 'Penggajian Dosen')

@section('main-content')
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
        @if(session('success'))
        <div class="alert alert-success alert-dismissible mx-3">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> BERHASIL!</h5>
            {{session('success')}}
        </div>
        @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible mx-3">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> GAGAL!</h5>
            {{session('error')}}
        </div>
        @endif
        <table id="gajiTable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="actionz">
            </tbody>
        </table>
    </div>
    <div class="ml-3">

    </div>
</div>


@endsection

@section('script')
<script>
    let bulan = `{{ date('m-Y') }}`;
    let url = `{{ route('admin.penggajian.dosen.detail', ['bulan' => '#bulan', 'dosen' => '#id']) }}`
    let urlp = `{{ route('admin.pdf.gaji.dosen', ['bulan' => '#bulan', 'pegawai' => '#id']) }}`
    $('.bulan').select2({
        theme: "bootstrap"
    });
    $("#tgl").change(() => {
        bulan = $("#tgl").val()
        initTable()
    })
    $("body").on("click", ".btn-edit", function(){
        let id = $(this).data("id")
        let urlEdit = url.replace("#bulan", bulan)
        urlEdit = urlEdit.replace("#id", id)
        window.location.href = urlEdit
    })

    $("body").on("click", ".btn-print", function(){
        let id = $(this).data("id")
        let urlPrint = urlp.replace("#bulan", bulan)
        urlPrint = urlPrint.replace("#id", id)
        window.location.href = urlPrint
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

    initTable()

    function initTable(){
        let urlTable = `{{route('admin.list.dosen.gaji')}}`
        $("#gajiTable").dataTable({
            lengthChange: false,
            destroy: true,
            // pageLength: 1,
            ajax: {
                url: urlTable,
                type: 'GET',
                data: {
                    tanggal: bulan,
                },
                dataSrc: function(res){
                    return res
                }
            },
            columns: [
                {data: "no"},
                {data: "nip"},
                {data: "nama"},
                {data: null, class:"text-center", orderable: false, render:function(data, type, row){
                    if (row.aksi > 0)
                        return `
                        <button class="btn btn-sm btn-primary btn-edit" data-id="${ row.id }"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-warning btn-print" data-id="${ row.id }"><i class="fas fa-print"></i></button>
                        `
                    else
                        return `
                            <button class="btn btn-sm btn-primary btn-edit" data-id="${ row.id }"><i class="fas fa-edit"></i></button>
                            `
                }},
            ]
        })
    }
</script>
@endsection