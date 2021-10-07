@extends('admin.template.dashboard')

@section('title', 'Edit Staff')

@section('main-content')
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="{{ route('admin.staff.update', $data->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" name="nip" class="form-control  @error('nip') is-invalid @enderror"
                    value="{{ old('nip', $data->nip) }}">
                @error('nip')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control  @error('nama') is-invalid @enderror"
                    value="{{ old('nama', $data->nama) }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="kategori">Jabatan</label>
                <select name="jabatan[]" multiple="multiple"
                    class="jabatan w-100  @error('jabatan') is-invalid @enderror" style="width: 100%">
                    <option @if ($data->staf_keuangan == 1) selected @endif value="keuangan">Keuangan</option>
                    <option @if ( $data->staf_hrd == 1) selected @endif value="hrd">HRD</option>
                    <option @if ( $data->staf_pemasaran == 1) selected @endif value="pemasaran">Pemasaran</option>
                </select>
                @error('jabatan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-block btn-primary">Edit</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(".jabatan").select2({
        theme: "bootstrap"
    })
</script>
@endsection