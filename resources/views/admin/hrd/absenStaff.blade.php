@extends('admin.template.dashboard')

@section('title', 'Absen Staff')

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
                    <th>Nama</th>
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

<div class="modal fade" id="modalHadir" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Absen Hadir</h5>
            </div>
            <div class="modal-body modal-absen">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-save">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalTidakHadir" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Absen Tidak Hadir</h5>
            </div>
            <div class="modal-body modal-tidak-absen">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-save">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    let totalDosen
    let table
    let urlPost = `{{ route('admin.absen.staff.post') }}`

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

    let dt = []

    function initTable(tgl){
        let urlTable = `{{ route('admin.absen.staff.list') }}`;
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
                    dt = res.absen
                    return res.data
                }
            },
            columns: [
                {data: "no"},
                {data: "nama"},
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

    $(document).on('click', '.hadir', function(){
        const kh = $(this).val()
        const id = $(this).data('id')
        if (kh == 1) {
            const element = `
                <select name="kehadiran" data-id="${id}" id="select-hadir" class="custom-select select2 mb-2">
                    <option value="hadir">Hadir</option>
                    <option value="cuti">Cuti</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                    <option value="nofinger">Tidak Finger</option>
                    <option value="telat">Telat</option>
                    <option value="sethari">Izin Setengah Hari</option>
                </select>`
            $('.modal-absen').html(element)
            $('#modalHadir').modal('show')
        }else if (kh == 0){
            const element = `
                <select name="tidakHadir" data-id="${id}" id="select-tidak-hadir" class="custom-select select2 mb-2">
                    <option value="tidak hadir">Tidak Hadir</option>
                    <option value="alpha">Izin / Sakit / Alpha</option>
                </select>`
            $('.modal-tidak-absen').html(element)
            $('#modalTidakHadir').modal('show')
        }
    })

    $('#modalHadir').on('show.bs.modal', function (e) {
        let keterangan =  $('select[name="kehadiran"]').val()
        let tmpId = $('#select-hadir').data('id')
        $('#select-hadir').change(function(){
            const val = $(this).val()
            keterangan = val
            tmpId = $(this).data('id')
            if (val == 'cuti') {
                $('.sakit').remove()
                const elm = `<select name="cuti" class="custom-select select2 cuti mb-2">
                                <option value="haid">Haid</option>
                                <option value="melahirkan">Melahirkan</option>
                                <option value="kerabat meninggal">Kerabat Meninggal</option>
                                <option value="menikah">Menikah</option>
                            </select>`
                $('.modal-absen').append(elm)
            }else if(val == 'sakit') {
                $('.cuti').remove()
                const elm = `<select name="sakit" class="custom-select select2 sakit mb-2">
                                <option value="ada">Ada Surat</option>
                                <option value="tidak">Tidak Ada Surat</option>
                            </select>`
                $('.modal-absen').append(elm)
            }else {
                $('.cuti').remove()
                $('.sakit').remove()
            }
        });
        $(".btn-save").click(function(){
            let tmp = {}
            tmp.is_izin = false
            tmp.is_hadir = true
            tmp.keterangan = keterangan
            tmp.id = tmpId
            if (keterangan == 'cuti') {
                const cuti = $('select[name="cuti"]').val()
                tmp.keterangan = keterangan + " " + cuti
            } else if(keterangan == 'sakit'){
                const sakit = $('select[name="sakit"]').val()
                if (sakit == 'tidak') {
                    tmp.is_izin = true 
                    tmp.keterangan = keterangan + " tidak ada surat"
                }else{
                    tmp.keterangan = keterangan + " ada surat"
                }
            } else if(keterangan == 'izin') {
                tmp.is_izin = true
            }
            index = dt.findIndex(obj => obj.id == tmpId)
            if (index != -1) dt[index] = tmp
            else dt.push(tmp)
            // dt[tmpId] = tmp
            $('#modalHadir').modal('hide')
        })
    })

    $('#modalTidakHadir').on('show.bs.modal', function (e) {
        const tmpId = $('#select-tidak-hadir').data('id')
        $(".btn-save").click(function(){
            let tmp = {}
            tmp.is_hadir = false
            tmp.id = tmpId
            tmp.keterangan = $('select[name="tidakHadir"]').val()
            index = dt.findIndex(obj => obj.id == tmpId)
            if (index != -1) dt[index] = tmp
            else dt.push(tmp)
            $('#modalTidakHadir').modal('hide')
            console.log(dt)
        })
    })

    $('.saveBtn').click(() => {
        console.log(dt)
        // return false;
        let kehadiran = table.$(".hadir:checked").map(function(){
            // dt.push($(this).data("id"))
            return $(this).val();
        }).get();
        
        if (kehadiran.length === totalDosen){
            let tgl = $("#tgl").val()
            $.ajax({
                url: urlPost,
                method: 'POST',
                data: {
                    data: dt,
                    tanggal: tgl,
                },
                success: (res) => {
                    if (res.status == 200)toastr.success("Berhasil menyimpan absen", "Absen")
                }
            })
        }else toastr.info("Harap absen semua", "Absen")
    })
</script>
@endsection