@extends('admin.template.dashboard')

@section('title', 'Master Gaji Dosen')

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
            <h4>Tunjangan : </h4>
            <hr>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="mengajar">Mengajar</label>
                        <input type="text" required name="mengajar"
                            class="form-control  @error('mengajar') is-invalid @enderror"
                            value="{{ old('mengajar', @$gaji->mengajar) }}">
                        @error('mengajar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="wali">Dosen Wali</label>
                        <input type="text" required name="wali"
                            class="form-control  @error('wali') is-invalid @enderror"
                            value="{{ old('wali', @$gaji->wali) }}">
                        @error('wali')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="transport">Transport</label>
                        <input type="text" required name="transport"
                            class="form-control  @error('transport') is-invalid @enderror"
                            value="{{ old('transport', @$gaji->transport) }}">
                        @error('transport')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <h4>Honor Mengajar: </h4>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="regular">Regular</label>
                        <input type="text" required name="regular"
                            class="form-control  @error('regular') is-invalid @enderror"
                            value="{{ old('regular', @$gaji->regular) }}">
                        @error('regular')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="karyawan">Karyawan</label>
                        <input type="text" required name="karyawan"
                            class="form-control  @error('karyawan') is-invalid @enderror"
                            value="{{ old('karyawan', @$gaji->karyawan) }}">
                        @error('karyawan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="eksekutif">Eksekutif / Smt Pendek</label>
                        <input type="text" required name="eksekutif"
                            class="form-control  @error('eksekutif') is-invalid @enderror"
                            value="{{ old('eksekutif', @$gaji->eksekutif) }}">
                        @error('eksekutif')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="interTeori">International Teori</label>
                        <input type="text" required name="interTeori"
                            class="form-control  @error('interTeori') is-invalid @enderror"
                            value="{{ old('interTeori', @$gaji->interTeori) }}">
                        @error('interTeori')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="interPraktek">International Praktek</label>
                        <input type="text" required name="interPraktek"
                            class="form-control  @error('interPraktek') is-invalid @enderror"
                            value="{{ old('interPraktek', @$gaji->interPraktek) }}">
                        @error('interPraktek')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="kerjaPraktek">Kerja Praktek</label>
                        <input type="text" required name="kerjaPraktek"
                            class="form-control  @error('kerjaPraktek') is-invalid @enderror"
                            value="{{ old('kerjaPraktek', @$gaji->kerjaPraktek) }}">
                        @error('kerjaPraktek')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <h5>Skripsi</h5>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="skripsi1">Skripsi I</label>
                        <input type="text" required name="skripsi1"
                            class="form-control  @error('skripsi1') is-invalid @enderror"
                            value="{{ old('skripsi1', @$gaji->skripsi1) }}">
                        @error('skripsi1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="skripsi2">Skripsi II</label>
                        <input type="text" required name="skripsi2"
                            class="form-control  @error('skripsi2') is-invalid @enderror"
                            value="{{ old('skripsi2', @$gaji->skripsi2) }}">
                        @error('skripsi2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <h5>Tugas Akhir</h5>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="ta1">Tugas Akhir I</label>
                        <input type="text" required name="ta1" class="form-control  @error('ta1') is-invalid @enderror"
                            value="{{ old('ta1', @$gaji->ta1) }}">
                        @error('ta1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="ta2">Tugas Akhir II</label>
                        <input type="text" required name="ta2" class="form-control  @error('ta2') is-invalid @enderror"
                            value="{{ old('ta2', @$gaji->ta2) }}">
                        @error('ta2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <h5>Penguji</h5>
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="seminarSkripsi">Seminar Skripsi</label>
                        <input type="text" required name="seminarSkripsi"
                            class="form-control  @error('seminarSkripsi') is-invalid @enderror"
                            value="{{ old('seminarSkripsi', @$gaji->seminarSkripsi) }}">
                        @error('seminarSkripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="seminarTerbuka">Seminar Terbuka</label>
                        <input type="text" required name="seminarTerbuka"
                            class="form-control  @error('seminarTerbuka') is-invalid @enderror"
                            value="{{ old('seminarTerbuka', @$gaji->seminarTerbuka) }}">
                        @error('seminarTerbuka')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="proposal">Proposal Tugas Akhir</label>
                        <input type="text" required name="proposal"
                            class="form-control  @error('proposal') is-invalid @enderror"
                            value="{{ old('proposal', @$gaji->proposal) }}">
                        @error('proposal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="ngujiTA">Tugas Akhir</label>
                        <input type="text" required name="ngujiTA"
                            class="form-control  @error('ngujiTA') is-invalid @enderror"
                            value="{{ old('ngujiTA', @$gaji->ngujiTA) }}">
                        @error('ngujiTA')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <h5>Koreksi</h5>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="koreksiRegular">Regular</label>
                        <input type="text" required name="koreksiRegular"
                            class="form-control  @error('koreksiRegular') is-invalid @enderror"
                            value="{{ old('koreksiRegular', @$gaji->koreksiRegular) }}">
                        @error('koreksiRegular')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="koreksiKaryawan">Karyawan</label>
                        <input type="text" required name="koreksiKaryawan"
                            class="form-control  @error('koreksiKaryawan') is-invalid @enderror"
                            value="{{ old('koreksiKaryawan', @$gaji->koreksiKaryawan) }}">
                        @error('koreksiKaryawan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="koreksiInter">International</label>
                        <input type="text" required name="koreksiInter"
                            class="form-control  @error('koreksiInter') is-invalid @enderror"
                            value="{{ old('koreksiInter', @$gaji->koreksiInter) }}">
                        @error('koreksiInter')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <h5>Soal</h5>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="soalRegular">Regular</label>
                        <input type="text" required name="soalRegular"
                            class="form-control  @error('soalRegular') is-invalid @enderror"
                            value="{{ old('soalRegular', @$gaji->soalRegular) }}">
                        @error('soalRegular')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="soalKaryawan">Karyawan</label>
                        <input type="text" required name="soalKaryawan"
                            class="form-control  @error('soalKaryawan') is-invalid @enderror"
                            value="{{ old('soalKaryawan', @$gaji->soalKaryawan) }}">
                        @error('soalKaryawan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="soalInter">International</label>
                        <input type="text" required name="soalInter"
                            class="form-control  @error('soalInter') is-invalid @enderror"
                            value="{{ old('soalInter', @$gaji->soalInter) }}">
                        @error('soalInter')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="dosenWali">Dosen Wali</label>
                        <input type="text" required name="dosenWali"
                            class="form-control  @error('dosenWali') is-invalid @enderror"
                            value="{{ old('dosenWali', @$gaji->dosenWali) }}">
                        @error('dosenWali')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="pengawas">Pengawas</label>
                        <input type="text" required name="pengawas"
                            class="form-control  @error('pengawas') is-invalid @enderror"
                            value="{{ old('pengawas', @$gaji->pengawas) }}">
                        @error('pengawas')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="lemburPengawas">Lembur Pengawas</label>
                        <input type="text" required name="lemburPengawas"
                            class="form-control  @error('lemburPengawas') is-invalid @enderror"
                            value="{{ old('lemburPengawas', @$gaji->lemburPengawas) }}">
                        @error('lemburPengawas')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="koor">Koor Mata Kuliah</label>
                        <input type="text" required name="koor"
                            class="form-control  @error('koor') is-invalid @enderror"
                            value="{{ old('koor', @$gaji->koor) }}">
                        @error('koor')
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