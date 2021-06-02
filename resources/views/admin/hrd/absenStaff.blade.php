@extends('admin.template.dashboard')

@section('title', 'Absen Staff')

@section('main-content')
<form action="" method="get" class="my-2 mx-3">
    <div class="input-group input-group-sm mb-3 w-25">
        <input type="text" class="form-control" name="search" value="{{ Request::get('search') }}">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>
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
                        <button class="btn btn-sm btn-primary absen-button mx-3" data-dosen="{{ $ban->id }}">
                            <i class="fas fa-file-signature"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="ml-3">
        {{ $dosen->withQueryString()->links('vendor.pagination.admin-bs') }}
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAdmin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Absen Dosen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.absen.staff.post') }}" method="POST" class="absen-form">
                @csrf
                <input type="hidden" name="dosen" value="" class="idDosen">
                <div class="modal-body form-group">
                    <label for="bulan">Bulan</label>
                    <select name="bulan" class="bulan w-100 form-control" style="width: 100%;">
                        @foreach ($bulan as $k)
                        <option value="{{ $k->id }}" {{ (date('n') == $k->id) ? 'selected' : '' }}>
                            {{ $k->name }}
                        </option>
                        @endforeach
                    </select>
                    <div class="form-group mt-3">
                        <label for="sks">Total Kehadiran</label>
                        <input type="text" name="absen" class="form-control sks" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Absen</button>
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
    });
    let tipe = "{{ route('admin.absen.staff') }}";
    if (performance.navigation.type == 1) window.location.href = tipe

    var id = '';
    $(".absen-button").click(function(e){
        e.preventDefault()
        let button = $(this);
        id = button.data('dosen');
        var ur = "{{ route('admin.cekAbsenStaff', [':dosen', ':bulan']) }}"
        ur = ur.replace(':dosen', id)
        ur = ur.replace(':bulan', $(".bulan").val())
        // console.log(ur)
        $.ajax({
            url: ur,
            dataType: 'json',
            success: function(data){
                $(".sks").val(data.absen)
                $(".idDosen").val(id)
                // console.log(data.absen)
                $("#modalAdmin").modal('show');
            }
        })
    });
    $(".bulan").change(function(e){
        var ur = "{{ route('admin.cekAbsenStaff', [':dosen', ':bulan']) }}"
        ur = ur.replace(':dosen', id)
        ur = ur.replace(':bulan', $(this).val())
        // console.log(ur)
        $.ajax({
            url: ur,
            dataType: 'json',
            success: function(data){
                if (data.msg == "Ada") $(".sks").val(data.absen)
                else $(".sks").val("")
            }
        })
    });
    $(".absen-form").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            dataType: 'json',
            data: $(this).serialize(),
            success: function(msg){
                if (msg == 'Sukses') Swal.fire("Sukses", "Berhasil Absen", "success").then((result) => {
                    if (result.isConfirmed) window.location.href = "";
                });
                else Swal.fire("Oops", "Something Wrong!", "error");
            }
        })
    })
</script>
@endsection