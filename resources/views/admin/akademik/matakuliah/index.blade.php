@extends('admin.template.dashboard')

@section('title', 'Matakuliah')

@section('main-content')
<a href="{{ route('admin.matakuliah.create') }}">
    <button class="btn btn-primary btn-sm mb-3 ml-3">Tambah Matakuliah</button>
</a>
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
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Jam</th>
                    <th>Hari</th>
                    <th>SKS</th>
                    <th>Kategori</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="actionz">
                @php
                $no=0;
                @endphp
                @foreach ($matakuliah as $matkul)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $matkul->kode }}</td>
                    <td>{{ $matkul->nama }}</td>
                    <td>{{ $matkul->jam }}</td>
                    <td>{{ $matkul->hari }}</td>
                    <td>{{ $matkul->sks }}</td>
                    <td>{{ $matkul->kategori }}</td>
                    <td class="text-center">
                        <div class="row" style="min-width: 100px">
                            <a href="{{ route('admin.matakuliah.edit', $matkul->id) }}" class="mx-3">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                            </a>
                            <form action="{{ route('admin.matakuliah.delete', $matkul->id) }}" method="POST"
                                class="deleted">
                                @method("DELETE")
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('script')
@endsection