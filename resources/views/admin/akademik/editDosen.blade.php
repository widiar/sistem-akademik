@extends('admin.template.dashboard')

@section('title', 'Update Dosen')

@section('main-content')
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="{{ route('admin.dosen.update', $dosen->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PATCH")
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" name="nip" class="form-control  @error('nip') is-invalid @enderror"
                    value="{{ old('nip', $dosen->nip) }}">
                @error('nip')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control  @error('nama') is-invalid @enderror"
                    value="{{ old('nama', $dosen->nama) }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori[]" multiple="multiple"
                    class="kategori w-100  @error('kategori') is-invalid @enderror">
                    @foreach ($dosen->kategori as $kat)
                    <option value="{{ $kat->id }}" selected>{{ $kat->kategori }}</option>
                    @endforeach
                    @foreach ($kategori as $k)
                    <option value="{{ $k->id }}"
                        {{ (is_array(old('kategori')) && in_array($k->id, old('kategori'))) ? ' selected' : '' }}>
                        {{ $k->kategori }}
                    </option>
                    @endforeach
                </select>
                @error('kategori')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <input type="hidden" name="tipe" value="{{ $tipe }}">
            <button type="submit" class="btn btn-block btn-primary">Update</button>
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