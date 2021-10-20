@extends('admin.template.dashboard')

@section('title', 'Penggajian Staff')

@section('main-content')
@if(session('success'))
<div class="alert alert-success alert-dismissible mx-3">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> BERHASIL!</h5>
    {{session('success')}}
</div>
@elseif(session('error'))
<div class="alert alert-danger alert-dismissible mx-3">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> GAGAL!</h5>
    {{session('error')}}
</div>
@endif
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="" method="POST" class="form-gaji">
            @csrf
            <h3>Gaji, Lembur dan Tunjangan</h3>
            <hr>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="gaji">Gaji Pokok</label>
                        <input type="text" required name="gaji"
                            class="form-control  @error('gaji') is-invalid @enderror"
                            value="{{ old('gaji', @$gaji->gaji) }}">
                        @error('gaji')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="lembur">Lembur</label>
                        <input type="text" required name="lembur"
                            class="form-control  @error('lembur') is-invalid @enderror"
                            value="{{ old('lembur', @$gaji->lembur) }}">
                        @error('lembur')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <h4>Tunjangan: </h4>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="makan">Uang Makan dan Transport</label>
                        <input type="text" required name="makan"
                            class="form-control  @error('makan') is-invalid @enderror"
                            value="{{ old('makan', @$gaji->makan) }}">
                        @error('makan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" required name="jabatan"
                            class="form-control  @error('jabatan') is-invalid @enderror"
                            value="{{ old('jabatan', @$gaji->jabatan) }}">
                        @error('jabatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="keahlian">Keahlian</label>
                        <input type="text" required name="keahlian"
                            class="form-control  @error('keahlian') is-invalid @enderror"
                            value="{{ old('keahlian', @$gaji->keahlian) }}">
                        @error('keahlian')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="pulsa">Pulsa</label>
                        <input type="text" required name="pulsa"
                            class="form-control  @error('pulsa') is-invalid @enderror"
                            value="{{ old('pulsa', @$gaji->pulsa) }}">
                        @error('pulsa')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="tol">Tol / Bensin</label>
                        <input type="text" required name="tol" class="form-control  @error('tol') is-invalid @enderror"
                            value="{{ old('tol', @$gaji->tol) }}">
                        @error('tol')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="kurangGaji">Kekurangan Gaji</label>
                        <input type="text" required name="kurangGaji"
                            class="form-control  @error('kurangGaji') is-invalid @enderror"
                            value="{{ old('kurangGaji', @$gaji->kurang_gaji) }}">
                        @error('kurangGaji')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="reward">Reward</label>
                        <input type="text" required name="reward"
                            class="form-control  @error('reward') is-invalid @enderror"
                            value="{{ old('reward', @$gaji->reward) }}">
                        @error('reward')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="thr">THR</label>
                        <input type="text" required name="thr" class="form-control  @error('thr') is-invalid @enderror"
                            value="{{ old('thr', @$gaji->thr) }}">
                        @error('thr')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <hr>
            <h3>Potongan</h3>
            <hr>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="bpjsKesehatan">BPJS Kesehatan</label>
                        <input type="text" required name="bpjsKesehatan"
                            class="form-control  @error('bpjsKesehatan') is-invalid @enderror"
                            value="{{ old('bpjsKesehatan', @$gaji->bpjs_kesehatan) }}">
                        @error('bpjsKesehatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="bpjsKerja">BPJS Ketenagakerjaan</label>
                        <input type="text" required name="bpjsKerja"
                            class="form-control  @error('bpjsKerja') is-invalid @enderror"
                            value="{{ old('bpjsKerja', @$gaji->bpjs_kerja) }}">
                        @error('bpjsKerja')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="izin">Izin/Sakit</label>
                        <input type="text" required name="izin"
                            class="form-control  @error('izin') is-invalid @enderror"
                            value="{{ old('izin', @$gaji->izin) }}">
                        @error('izin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="telat">Telat / Short Time / No Finger</label>
                        <input type="text" required name="telat"
                            class="form-control  @error('telat') is-invalid @enderror"
                            value="{{ old('telat', @$gaji->telat) }}">
                        @error('telat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="alpha">I/S/A Non alphaeransi</label>
                        <input type="text" required name="alpha"
                            class="form-control  @error('alpha') is-invalid @enderror"
                            value="{{ old('alpha', @$gaji->alpha) }}">
                        @error('alpha')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="sanksi">Sanksi SP</label>
                        <input type="text" required name="sanksi"
                            class="form-control  @error('sanksi') is-invalid @enderror"
                            value="{{ old('sanksi', @$gaji->sanksi) }}">
                        @error('sanksi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="kasbon">Kasbon</label>
                        <input type="text" required name="kasbon"
                            class="form-control  @error('kasbon') is-invalid @enderror"
                            value="{{ old('kasbon', @$gaji->kasbon) }}">
                        @error('kasbon')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="makanNonDinas">Uang Makan Non Dinas</label>
                        <input type="text" required name="makanNonDinas"
                            class="form-control  @error('makanNonDinas') is-invalid @enderror"
                            value="{{ old('makanNonDinas', @$gaji->makanNonDinas) }}">
                        @error('makanNonDinas')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="potonganLain">Potongan Lain-Lain</label>
                        <input type="text" required name="potonganLain"
                            class="form-control  @error('potonganLain') is-invalid @enderror"
                            value="{{ old('potonganLain', @$gaji->potonganLain) }}">
                        @error('potonganLain')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="float-right">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script>
    $('.form-control').simpleMoneyFormat();
</script>
@endsection