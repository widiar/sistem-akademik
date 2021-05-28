@extends('admin.template.dashboard')

@section('title', 'Add Dosen')

@section('main-content')
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="{{ route('admin.dosen.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" name="nip" class="form-control  @error('nip') is-invalid @enderror"
                    value="{{ old('nip') }}">
                @error('nip')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control  @error('nama') is-invalid @enderror"
                    value="{{ old('nama') }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori[]" multiple="multiple"
                    class="kategori w-100  @error('kategori') is-invalid @enderror">
                    @foreach ($kategori as $k)
                    <option value="{{ $k->id }}"
                        {{ (is_array(old('kategori')) && in_array($k->id, old('kategori'))) ? ' selected' : '' }}>
                        {{ $k->kategori }}
                    </option>
                    @endforeach
                </select>
                {{-- <input type="text" name="kategori" class="form-control  @error('kategori') is-invalid @enderror"
                    value="{{ old('kategori') }}"> --}}
                @error('kategori')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <input type="hidden" name="tipe" value="{{ $tipe }}">
            <button type="submit" class="btn btn-block btn-primary">Tambah</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.kategori').select2();
    });
</script>
@endsection