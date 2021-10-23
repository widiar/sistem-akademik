@extends('admin.template.dashboard')

@section('title', 'Dosen')

@section('main-content')
{{-- <form action="" method="get" class="my-2 mx-3">
    <div class="input-group input-group-sm mb-3 w-25">
        <input type="text" class="form-control" name="search" value="{{ Request::get('search') }}">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form> --}}
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
<div class="tanggal mx-3">
    <label for="">Pilih Tanggal</label>
    <div class="input-group w-50">
        <input type="text" id="tgl" class="form-control datepicker" value="{{ $now }}">
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
        </div>
    </div>
</div>
<div class="card shadow mx-3">
    <div class="card-body table-responsive">
        <table id="absenTable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Matakuliah</th>
                    <th>Nama</th>
                    <th>Jam</th>
                    <th class="text-center">Hadir</th>
                    <th class="text-center">Tidak Hadir</th>
                </tr>
            </thead>
            <tbody class="actionz">
            </tbody>
        </table>
        <button class="btn btn-primary float-right mt-3 saveBtn">Save</button>
    </div>
</div>


@endsection

@section('script')
<script>
    let totalDosen
    let table
    let urlPost = `{{ route('admin.post.absen.dosen') }}`
    
    $('.bulan').select2({
        theme: "bootstrap"
    });

    $(".datepicker").datepicker({
        format: 'dd-mm-yyyy',
        todayBtn: "linked",
        // daysOfWeekDisabled: "0,6",
        autoclose: true,
        endDate: "+0d",
        todayHighlight: true
    });

    initTable($("#tgl").val())

    $(".datepicker").change(() =>{
        let tgl = $("#tgl").val()
        initTable(tgl)
    });

    function initTable(tgl){
        let urlTable = `{{ route('admin.list.absen.dosen') }}`;
        table = $("#absenTable").dataTable({
            lengthChange: false,
            destroy: true,
            // pageLength: 1,
            ajax: {
                url: urlTable,
                type: 'GET',
                data: {
                    tanggal: tgl
                },
                dataSrc: function(res){
                    totalDosen = res.total
                    return res.data
                }
            },
            columns: [
                {data: "no"},
                {data: "matakuliah"},
                {data: "nama"},
                {data: "jam"},
                {data: null, class:"text-center", orderable: false, render:function(data, type, row){
                    if (row.f == 1){
                        let cheked = (row.absen == 1) ? 'checked' : ''
                        return `<input class="form-check-input hadir" ${cheked} type="radio" value="1" name="hadir[${row.id}]" data-id="${row.id}">`
                    }else
                        return `<input class="form-check-input hadir" type="radio" value="1" name="hadir[${row.id}]" data-id="${row.id}">`
                }},
                {data: null, class:"text-center", orderable: false, render:function(data, type, row){
                    if (row.f == 1){
                        let cheked = (row.absen == 0) ? 'checked' : ''
                        return `<input class="form-check-input hadir" ${cheked} type="radio" value="0" name="hadir[${row.id}]" data-id="${row.id}">`
                    }else
                        return `<input class="form-check-input hadir" type="radio" value="0" name="hadir[${row.id}]" data-id="${row.id}">`
                }},
            ]
        })
    }

    $('.saveBtn').click(() => {
        let dt = []
        let kehadiran = table.$(".hadir:checked").map(function(){
            dt.push($(this).data("id"))
            return $(this).val();
        }).get();
        
        if (kehadiran.length === totalDosen){
            let tgl = $("#tgl").val()
            $.ajax({
                url: urlPost,
                method: 'POST',
                data: {
                    absen: kehadiran,
                    id: dt,
                    tanggal: tgl
                },
                success: (res) => {
                    if (res.status == 200) window.location.href = ''
                }
            })
        }else toastr.info("Harap absen semua", "Absen")
    })
</script>
@endsection