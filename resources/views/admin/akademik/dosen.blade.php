@extends('admin.template.dashboard')

@section('title', 'Dosen')

@section('main-content')
{{-- <a href="{{ route('admin.dosen.create') }}">
    <button class="btn btn-primary btn-sm mb-3 ml-3">Tambah Dosen</button>
</a> --}}
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
                    <th>Kategori</th>
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
                    <td>
                        @foreach ($ban->dosen as $kat)
                        {{ $kat->kategori . ", " }}
                        @endforeach
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.dosen.edit', [$ban->id]) }}" class="mx-3">
                            <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                        </a>
                        {{-- <div class="row" style="min-width: 100px">
                            <form action="{{ route('admin.dosen.destroy', $ban->id) }}" method="POST" class="deleted">
                                @method("DELETE")
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </div> --}}
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    {{-- <div class="ml-3">
        {{ $dosen->withQueryString()->links('vendor.pagination.admin-bs') }}
    </div> --}}
</div>

@endsection

@section('script')
<script>

</script>
@endsection