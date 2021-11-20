@extends('admin.template.dashboard')

@section('title', 'Hari Efektif')

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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">
            Tambah Hari Efektif
        </button>
    </div>
</div>
<div class="card shadow mx-3">
    <div class="card-body table-responsive">
        <table id="adminTable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="actionz">
                @php
                $no=0;
                @endphp
                @foreach ($data as $dt)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $dt->jumlah }}</td>
                    <td>{{ date('F', mktime(0, 0, 0, $dt->bulan, 10)) . ", " . $dt->tahun }}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-primary btn-edit" data-tanggal="{{ $dt->bulan . '-' . $dt->tahun
                            }}" data-jumlah="{{ $dt->jumlah }}">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Hari Efektif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <label for="">Bulan</label>
                    <div class="input-group">
                        <input type="text" id="tgl" name="tanggal" required class="form-control datepicker"
                            value="{{ date('m-Y') }}">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="jumlah">Jumlah Hari</label>
                        <input class="form-control" type="number" name="jumlah" min="0" max="28" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Hari Efektif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <label for="">Bulan</label>
                    <div class="input-group">
                        <input type="text" id="tglEdit" readonly name="tanggal" required
                            class="form-control datepicker">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="jumlah">Jumlah Hari</label>
                        <input class="form-control" type="number" id="jumlahEdit" name="jumlah" min="0" max="28"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $('.bulan').select2({
        theme: "bootstrap"
    })
    $("body").on("click", ".btn-edit", function(){
        const tanggal = $(this).data('tanggal')
        const jumlah = $(this).data('jumlah')
        $('#tglEdit').val(tanggal)
        $('#jumlahEdit').val(jumlah)
        $('#modalEdit').modal('show');
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