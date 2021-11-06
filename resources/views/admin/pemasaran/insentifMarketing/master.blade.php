@extends('admin.template.dashboard')

@section('title', 'Master Insentif Marketing')

@section('main-content')
<div class="card shadow mx-3">
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> BERHASIL!</h5>
            {{session('success')}}
        </div>
        @endif
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="daftar">Presenter Daftar</label>
                <input type="text" name="daftar" class="form-control  @error('daftar') is-invalid @enderror"
                    value="{{ old('daftar', @$data->daftar) }}">
                @error('daftar')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="regular">Registrasi Regular</label>
                <input type="text" name="regular" class="form-control  @error('regular') is-invalid @enderror"
                    value="{{ old('regular', @$data->regular) }}">
                @error('regular')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="karyawan">Registrasi Karyawan</label>
                <input type="text" name="karyawan" class="form-control  @error('karyawan') is-invalid @enderror"
                    value="{{ old('karyawan', @$data->karyawan) }}">
                @error('karyawan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="international">Registrasi Internasional</label>
                <input type="text" name="international"
                    class="form-control  @error('international') is-invalid @enderror"
                    value="{{ old('international', @$data->international) }}">
                @error('international')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="wawancara">Wawancara</label>
                <input type="text" name="wawancara" class="form-control  @error('wawancara') is-invalid @enderror"
                    value="{{ old('wawancara', @$data->wawancara) }}">
                @error('wawancara')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-block btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $('input[type="text"]').simpleMoneyFormat()
</script>
@endsection