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

<!-- Modal -->
<div class="modal fade" id="modalAdmin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tahun Ajaran {{ tahunAjaran() }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.intensif-marketing.store') }}" method="POST" class="absen-form">
                @csrf
                <input type="hidden" name="dosen" value="" class="idDosen">
                <div class="modal-body">
                    <div class="form-group mt-3">
                        <label for="sks">Jumlah Mahasiswa</label>
                        <input type="number" name="jumlah" class="form-control sks" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
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
    // let tipe = "{{ route('admin.intensif-marketing.index') }}";
    // if (performance.navigation.type == 1) window.location.href = tipe

    var id = '';
    $(".intensif-button").click(function(e){
        e.preventDefault()
        let button = $(this);
        id = button.data('dosen');
        var u = "{{ route('admin.intensif-marketing.show', 0) }}"
        var ur = u.substring(0, u.length-1) + id;
        // console.log(ur)
        $.ajax({
            url: ur,
            dataType: 'json',
            success: function(data){
                $(".sks").val(data.jumlah)
                $(".idDosen").val(id)
                // console.log(data.absen)
                $("#modalAdmin").modal('show');
            }
        })
    });
</script>
@endsection