@extends('admin.template.dashboard')

@section('title', 'Penggajian Staff')

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
    let bulan = `{{ date('n') }}`;
    let url = `{{ route('admin.penggajian.staff.detail', ['bulan' => '#bulan', 'staff' => '#id']) }}`
    let urlp = `{{ route('admin.pdf.gaji.staff', ['bulan' => '#bulan', 'pegawai' => '#id']) }}`
    $('.bulan').select2({
        theme: "bootstrap"
    });
    $(".bulan").change(() => {
        bulan = $(".bulan").val()
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

    initTable()

    function initTable(){
        let urlTable = `{{route('admin.list.staff.gaji')}}`
        let tahun = `{{ date('Y') }}`
        $("#gajiTable").dataTable({
            lengthChange: false,
            destroy: true,
            // pageLength: 1,
            ajax: {
                url: urlTable,
                type: 'GET',
                data: {
                    bulan: bulan,
                    tahun: tahun
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