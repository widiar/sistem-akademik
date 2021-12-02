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
                    <label for="total_daftar_regular">Total Daftar Regular</label>
                    <input required type="number" required name="total_daftar_regular"
                        class="form-control  @error('total_daftar_regular') is-invalid @enderror"
                        value="{{ old('total_daftar_regular', @$data->total_daftar_regular) }}">
                    @error('total_daftar_regular')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="daftar_regular">Daftar Regular</label>
                    <input type="number" readonly required name="daftar_regular"
                        class="form-control  @error('daftar_regular') is-invalid @enderror"
                        value="{{ old('daftar_regular', @$data->daftar_regular) }}">
                    @error('daftar_regular')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    <label for="total_daftar_dd_inter">Total Daftar Dual Degree Internasional</label>
                    <input required type="number" required name="total_daftar_dd_inter"
                        class="form-control  @error('total_daftar_dd_inter') is-invalid @enderror"
                        value="{{ old('total_daftar_dd_inter', @$data->total_daftar_dd_inter) }}">
                    @error('total_daftar_dd_inter')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="daftar_dd_inter">Daftar Dual Degree Internasional</label>
                    <input type="number" readonly required name="daftar_dd_inter"
                        class="form-control  @error('daftar_dd_inter') is-invalid @enderror"
                        value="{{ old('daftar_dd_inter', @$data->daftar_dd_inter) }}">
                    @error('daftar_dd_inter')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    <label for="total_daftar_dd_nasional">Total Daftar Dual Degree Nasional</label>
                    <input required type="number" required name="total_daftar_dd_nasional"
                        class="form-control  @error('total_daftar_dd_nasional') is-invalid @enderror"
                        value="{{ old('total_daftar_dd_nasional', @$data->total_daftar_dd_nasional) }}">
                    @error('total_daftar_dd_nasional')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="daftar_dd_nasional">Daftar Dual Degree Nasional</label>
                    <input type="number" readonly required name="daftar_dd_nasional"
                        class="form-control  @error('daftar_dd_nasional') is-invalid @enderror"
                        value="{{ old('daftar_dd_nasional', @$data->daftar_dd_nasional) }}">
                    @error('daftar_dd_nasional')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    <label for="total_registrasi_regular">Total Registrasi Regular</label>
                    <input required type="number" required name="total_registrasi_regular"
                        class="form-control  @error('total_registrasi_regular') is-invalid @enderror"
                        value="{{ old('total_registrasi_regular', @$data->total_registrasi_regular) }}">
                    @error('total_registrasi_regular')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="registrasi_regular">Registrasi Regular</label>
                    <input type="number" readonly required name="registrasi_regular"
                        class="form-control  @error('registrasi_regular') is-invalid @enderror"
                        value="{{ old('registrasi_regular', @$data->registrasi_regular) }}">
                    @error('registrasi_regular')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    <label for="total_registrasi_bisnis">Total Registrasi Bisnis</label>
                    <input required type="number" required name="total_registrasi_bisnis"
                        class="form-control  @error('total_registrasi_bisnis') is-invalid @enderror"
                        value="{{ old('total_registrasi_bisnis', @$data->total_registrasi_bisnis) }}">
                    @error('total_registrasi_bisnis')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="registrasi_bisnis">Registrasi Bisnis</label>
                    <input type="number" readonly required name="registrasi_bisnis"
                        class="form-control  @error('registrasi_bisnis') is-invalid @enderror"
                        value="{{ old('registrasi_bisnis', @$data->registrasi_bisnis) }}">
                    @error('registrasi_bisnis')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    <label for="total_registrasi_dd_inter">Total Registrasi Double Degree International</label>
                    <input required type="number" required name="total_registrasi_dd_inter"
                        class="form-control  @error('total_registrasi_dd_inter') is-invalid @enderror"
                        value="{{ old('total_registrasi_dd_inter', @$data->total_registrasi_dd_inter) }}">
                    @error('total_registrasi_dd_inter')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="registrasi_dd_inter">Registrasi Double Degree International</label>
                    <input type="number" readonly required name="registrasi_dd_inter"
                        class="form-control  @error('registrasi_dd_inter') is-invalid @enderror"
                        value="{{ old('registrasi_dd_inter', @$data->registrasi_dd_inter) }}">
                    @error('registrasi_dd_inter')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    <label for="total_registrasi_dd_nasional">Total Registrasi Double Degree Nasional</label>
                    <input required type="number" required name="total_registrasi_dd_nasional"
                        class="form-control  @error('total_registrasi_dd_nasional') is-invalid @enderror"
                        value="{{ old('total_registrasi_dd_nasional', @$data->total_registrasi_dd_nasional) }}">
                    @error('total_registrasi_dd_nasional')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="registrasi_dd_nasional">Registrasi Double Degree Nasional</label>
                    <input type="number" readonly required name="registrasi_dd_nasional"
                        class="form-control  @error('registrasi_dd_nasional') is-invalid @enderror"
                        value="{{ old('registrasi_dd_nasional', @$data->registrasi_dd_nasional) }}">
                    @error('registrasi_dd_nasional')
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
        let total_daftar_regular = parseInt($('input[name="total_daftar_regular"]').val()) || 0
        let total_daftar_dd_inter = parseInt($('input[name="total_daftar_dd_inter"]').val()) || 0
        let total_daftar_dd_nasional = parseInt($('input[name="total_daftar_dd_nasional"]').val()) || 0
        let total_registrasi_regular = parseInt($('input[name="total_registrasi_regular"]').val()) || 0
        let total_registrasi_bisnis = parseInt($('input[name="total_registrasi_bisnis"]').val()) || 0
        let total_registrasi_dd_inter = parseInt($('input[name="total_registrasi_dd_inter"]').val()) || 0
        let total_registrasi_dd_nasional = parseInt($('input[name="total_registrasi_dd_nasional"]').val()) || 0
        let totalWawancara = parseInt($('input[name="wawancaraTotal"]').val()) || 0

        let daftar_regular = parseInt($('input[name="daftar_regular"]').val()) || 0
        let daftar_dd_inter = parseInt($('input[name="daftar_dd_inter"]').val()) || 0
        let daftar_dd_nasional = parseInt($('input[name="daftar_dd_nasional"]').val()) || 0
        let registrasi_regular = parseInt($('input[name="registrasi_regular"]').val()) || 0
        let registrasi_bisnis = parseInt($('input[name="registrasi_bisnis"]').val()) || 0
        let registrasi_dd_inter = parseInt($('input[name="registrasi_dd_inter"]').val()) || 0
        let registrasi_dd_nasional = parseInt($('input[name="registrasi_dd_nasional"]').val()) || 0
        let wawancara = parseInt($('input[name="wawancara"]').val()) || 0

        total = (total_daftar_regular * daftar_regular) + (total_daftar_dd_inter * daftar_dd_inter) + (total_daftar_dd_nasional * daftar_dd_nasional) + (total_registrasi_regular * registrasi_regular) + (total_registrasi_bisnis * registrasi_bisnis) + (total_registrasi_dd_inter * registrasi_dd_inter) + (total_registrasi_dd_nasional * registrasi_dd_nasional) + (totalWawancara * wawancara)
        $('#total').text(total)
        $("input[name='total']").val(total)
        $('#total').simpleMoneyFormat()
    }
    // $('#form').submit(function(){
    //     $("input[name='total']").val(total)
    // })
</script>
@endsection