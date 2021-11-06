@extends('admin.template.dashboard')

@section('title', 'Master Insentif Marketing')

@section('main-content')
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data" id="form">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    <label for="daftarTotal">Total Presenter Daftar</label>
                    <input type="number" required name="daftarTotal"
                        class="form-control  @error('daftarTotal') is-invalid @enderror"
                        value="{{ old('daftarTotal', @$data->total_daftar) }}">
                    @error('daftarTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="daftar">Presenter Daftar</label>
                    <input type="number" readonly required name="daftar"
                        class="form-control  @error('daftar') is-invalid @enderror"
                        value="{{ old('daftar', @$data->daftar) }}">
                    @error('daftar')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    <label for="regularTotal">Total Registrasi Regular</label>
                    <input type="number" required name="regularTotal"
                        class="form-control  @error('regularTotal') is-invalid @enderror"
                        value="{{ old('regularTotal', @$data->total_regular) }}">
                    @error('regularTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="regular">Registrasi Regular</label>
                    <input type="number" required readonly name="regular"
                        class="form-control  @error('regular') is-invalid @enderror"
                        value="{{ old('regular', @$data->regular) }}">
                    @error('regular')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    <label for="karyawanTotal">Total Registrasi Karyawan</label>
                    <input type="number" required name="karyawanTotal"
                        class="form-control  @error('karyawanTotal') is-invalid @enderror"
                        value="{{ old('karyawanTotal', @$data->total_karyawan) }}">
                    @error('karyawanTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="karyawan">Registrasi Karyawan</label>
                    <input type="number" required readonly name="karyawan"
                        class="form-control  @error('karyawan') is-invalid @enderror"
                        value="{{ old('karyawan', @$data->karyawan) }}">
                    @error('karyawan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    <label for="internationalTotal">Total Registrasi Internasional</label>
                    <input type="number" required name="internationalTotal"
                        class="form-control  @error('internationalTotal') is-invalid @enderror"
                        value="{{ old('internationalTotal', @$data->total_international) }}">
                    @error('internationalTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="international">Registrasi Internasional</label>
                    <input type="number" required readonly name="international"
                        class="form-control  @error('international') is-invalid @enderror"
                        value="{{ old('international', @$data->international) }}">
                    @error('international')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    <label for="wawancaraTotal">Total Wawancara</label>
                    <input type="number" required name="wawancaraTotal"
                        class="form-control  @error('wawancaraTotal') is-invalid @enderror"
                        value="{{ old('wawancaraTotal', @$data->total_wawancara) }}">
                    @error('wawancaraTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="wawancara">Wawancara</label>
                    <input type="number" required readonly name="wawancara"
                        class="form-control  @error('wawancara') is-invalid @enderror"
                        value="{{ old('wawancara', @$data->wawancara) }}">
                    @error('wawancara')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h2>Total Insentif: Rp. <span id="total"></span></h2>
            <input type="hidden" name="total">

            <button type="submit" class="btn btn-block btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    let total = 0
    $('input[type="number"]').keyup(initTotal)
    initTotal();
    function initTotal(){
        let totalDaftar = parseInt($('input[name="daftarTotal"]').val()) || 0
        let totalRegular = parseInt($('input[name="regularTotal"]').val()) || 0
        let totalKaryawan = parseInt($('input[name="karyawanTotal"]').val()) || 0
        let totalInternational = parseInt($('input[name="internationalTotal"]').val()) || 0
        let totalWawancara = parseInt($('input[name="wawancaraTotal"]').val()) || 0

        let daftar = parseInt($('input[name="daftar"]').val()) || 0
        let regular = parseInt($('input[name="regular"]').val()) || 0
        let karyawan = parseInt($('input[name="karyawan"]').val()) || 0
        let international = parseInt($('input[name="international"]').val()) || 0
        let wawancara = parseInt($('input[name="wawancara"]').val()) || 0

        total = (totalDaftar * daftar) + (totalRegular * regular) + (totalKaryawan * karyawan) + (totalInternational * international) + (totalWawancara * wawancara)
        $('#total').text(total)
        $('#total').simpleMoneyFormat()
    }
    $('#form').submit(function(){
        $("input[name='total']").val(total)
    })
</script>
@endsection