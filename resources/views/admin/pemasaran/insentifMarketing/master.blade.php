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
                <label for="daftar_regular">Daftar Regular</label>
                <input required type="text" name="daftar_regular"
                    class="form-control  @error('daftar_regular') is-invalid @enderror"
                    value="{{ old('daftar_regular', @$data->daftar_regular) }}">
                @error('daftar_regular')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="daftar_dd_inter">Daftar Double Degree International</label>
                <input required type="text" name="daftar_dd_inter"
                    class="form-control  @error('daftar_dd_inter') is-invalid @enderror"
                    value="{{ old('daftar_dd_inter', @$data->daftar_dd_inter) }}">
                @error('daftar_dd_inter')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="daftar_dd_nasional">Daftar Double Degree Nasional</label>
                <input required type="text" name="daftar_dd_nasional"
                    class="form-control  @error('daftar_dd_nasional') is-invalid @enderror"
                    value="{{ old('daftar_dd_nasional', @$data->daftar_dd_nasional) }}">
                @error('daftar_dd_nasional')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="registrasi_regular">Registrasi Regular</label>
                <input required type="text" name="registrasi_regular"
                    class="form-control  @error('registrasi_regular') is-invalid @enderror"
                    value="{{ old('registrasi_regular', @$data->registrasi_regular) }}">
                @error('registrasi_regular')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="registrasi_bisnis">Registrasi Bisnis</label>
                <input required type="text" name="registrasi_bisnis"
                    class="form-control  @error('registrasi_bisnis') is-invalid @enderror"
                    value="{{ old('registrasi_bisnis', @$data->registrasi_bisnis) }}">
                @error('registrasi_bisnis')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="registrasi_dd_inter">Registrasi Double Degree Internasional</label>
                <input required type="text" name="registrasi_dd_inter"
                    class="form-control  @error('registrasi_dd_inter') is-invalid @enderror"
                    value="{{ old('registrasi_dd_inter', @$data->registrasi_dd_inter) }}">
                @error('registrasi_dd_inter')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="registrasi_dd_nasional">Registrasi Double Degree Nasional</label>
                <input required type="text" name="registrasi_dd_nasional"
                    class="form-control  @error('registrasi_dd_nasional') is-invalid @enderror"
                    value="{{ old('registrasi_dd_nasional', @$data->registrasi_dd_nasional) }}">
                @error('registrasi_dd_nasional')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="wawancara">Wawancara</label>
                <input required type="text" name="wawancara"
                    class="form-control  @error('wawancara') is-invalid @enderror"
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