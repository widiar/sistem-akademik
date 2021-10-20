@extends('admin.template.dashboard')

@section('title', 'Penggajian Dosen')

@section('main-content')
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
                        <input type="text" required readonly name="mengajar"
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
                        <input type="text" required readonly name="wali"
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
                        <input type="text" required readonly name="transport"
                            class="form-control  @error('transport') is-invalid @enderror"
                            value="{{ old('transport', @$gaji->transport) }}">
                        @error('transport')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <h4>Honor Mengajar: </h4>
            <div class="form-row">
                <div class="form-group col">
                    <label for="absen">Absen</label>
                    <input type="text" required readonly name="absen"
                        class="form-control  @error('absen') is-invalid @enderror"
                        value="{{ old('absen', @$absen->count()) }}">
                    @error('absen')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="regular">Regular</label>
                    <input type="text" required readonly name="regular"
                        class="form-control  @error('regular') is-invalid @enderror"
                        value="{{ old('regular', @$gaji->regular) }}">
                    @error('regular')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="karyawanTotal">Total</label>
                    <input type="text" required name="karyawanTotal"
                        class="form-control  @error('karyawanTotal') is-invalid @enderror"
                        value="{{ old('karyawanTotal') }}">
                    @error('karyawanTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="karyawan">Karyawan</label>
                    <input type="text" required readonly name="karyawan"
                        class="form-control  @error('karyawan') is-invalid @enderror"
                        value="{{ old('karyawan', @$gaji->karyawan) }}">
                    @error('karyawan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="eksekutifTotal">Total</label>
                    <input type="text" required name="eksekutifTotal"
                        class="form-control  @error('eksekutifTotal') is-invalid @enderror"
                        value="{{ old('eksekutifTotal') }}">
                    @error('eksekutifTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="eksekutif">Eksekutif / Smt Pendek</label>
                    <input type="text" required readonly name="eksekutif"
                        class="form-control  @error('eksekutif') is-invalid @enderror"
                        value="{{ old('eksekutif', @$gaji->eksekutif) }}">
                    @error('eksekutif')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="interTeoriTotal">Total</label>
                    <input type="text" required name="interTeoriTotal"
                        class="form-control  @error('interTeoriTotal') is-invalid @enderror"
                        value="{{ old('interTeoriTotal') }}">
                    @error('interTeoriTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="interTeori">International Teori</label>
                    <input type="text" required readonly name="interTeori"
                        class="form-control  @error('interTeori') is-invalid @enderror"
                        value="{{ old('interTeori', @$gaji->interTeori) }}">
                    @error('interTeori')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="interPraktekTotal">Total</label>
                    <input type="text" required name="interPraktekTotal"
                        class="form-control  @error('interPraktekTotal') is-invalid @enderror"
                        value="{{ old('interPraktekTotal') }}">
                    @error('interPraktekTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="interPraktek">International Praktek</label>
                    <input type="text" required readonly name="interPraktek"
                        class="form-control  @error('interPraktek') is-invalid @enderror"
                        value="{{ old('interPraktek', @$gaji->interPraktek) }}">
                    @error('interPraktek')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="kerjaPraktekTotal">Total</label>
                    <input type="text" required name="kerjaPraktekTotal"
                        class="form-control  @error('kerjaPraktekTotal') is-invalid @enderror"
                        value="{{ old('kerjaPraktekTotal') }}">
                    @error('kerjaPraktekTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="kerjaPraktek">Kerja Praktek</label>
                    <input type="text" required readonly name="kerjaPraktek"
                        class="form-control  @error('kerjaPraktek') is-invalid @enderror"
                        value="{{ old('kerjaPraktek', @$gaji->kerjaPraktek) }}">
                    @error('kerjaPraktek')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <hr>
            <h5>Skripsi</h5>
            <div class="form-row">
                <div class="form-group col">
                    <label for="skripsi1Total">Total</label>
                    <input type="text" required name="skripsi1Total"
                        class="form-control  @error('skripsi1Total') is-invalid @enderror"
                        value="{{ old('skripsi1Total') }}">
                    @error('skripsi1Total')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="skripsi1">Skripsi I</label>
                    <input type="text" required readonly name="skripsi1"
                        class="form-control  @error('skripsi1') is-invalid @enderror"
                        value="{{ old('skripsi1', @$gaji->skripsi1) }}">
                    @error('skripsi1')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="skripsi2Total">Total</label>
                    <input type="text" required name="skripsi2Total"
                        class="form-control  @error('skripsi2Total') is-invalid @enderror"
                        value="{{ old('skripsi2Total') }}">
                    @error('skripsi2Total')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="skripsi2">Skripsi II</label>
                    <input type="text" required readonly name="skripsi2"
                        class="form-control  @error('skripsi2') is-invalid @enderror"
                        value="{{ old('skripsi2', @$gaji->skripsi2) }}">
                    @error('skripsi2')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <hr>
            <div class="ta">
                <h5>Tugas Akhir</h5>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="ta1Total">Total</label>
                        <input type="text" required name="ta1Total"
                            class="form-control  @error('ta1Total') is-invalid @enderror" value="{{ old('ta1Total') }}">
                        @error('ta1Total')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="ta1">Tugas Akhir I</label>
                        <input type="text" required readonly name="ta1"
                            class="form-control  @error('ta1') is-invalid @enderror"
                            value="{{ old('ta1', @$gaji->ta1) }}">
                        @error('ta1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="ta2Total">Total</label>
                        <input type="text" required name="ta2Total"
                            class="form-control  @error('ta2Total') is-invalid @enderror" value="{{ old('ta2Total') }}">
                        @error('ta2Total')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="ta2">Tugas Akhir II</label>
                        <input type="text" required readonly name="ta2"
                            class="form-control  @error('ta2') is-invalid @enderror"
                            value="{{ old('ta2', @$gaji->ta2) }}">
                        @error('ta2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <hr>
            <div class="penguji">
                <h5>Penguji</h5>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="seminarSkripsiTotal">Total</label>
                        <input type="text" required name="seminarSkripsiTotal"
                            class="form-control  @error('seminarSkripsiTotal') is-invalid @enderror"
                            value="{{ old('seminarSkripsiTotal') }}">
                        @error('seminarSkripsiTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="seminarSkripsi">Seminar Skripsi</label>
                        <input type="text" required readonly name="seminarSkripsi"
                            class="form-control  @error('seminarSkripsi') is-invalid @enderror"
                            value="{{ old('seminarSkripsi', @$gaji->seminarSkripsi) }}">
                        @error('seminarSkripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="seminarTerbukaTotal">Total</label>
                        <input type="text" required name="seminarTerbukaTotal"
                            class="form-control  @error('seminarTerbukaTotal') is-invalid @enderror"
                            value="{{ old('seminarTerbukaTotal') }}">
                        @error('seminarTerbukaTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="seminarTerbuka">Seminar Terbuka</label>
                        <input type="text" required readonly name="seminarTerbuka"
                            class="form-control  @error('seminarTerbuka') is-invalid @enderror"
                            value="{{ old('seminarTerbuka', @$gaji->seminarTerbuka) }}">
                        @error('seminarTerbuka')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="proposalTotal">Total</label>
                        <input type="text" required name="proposalTotal"
                            class="form-control  @error('proposalTotal') is-invalid @enderror"
                            value="{{ old('proposalTotal') }}">
                        @error('proposalTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="proposal">Proposal Tugas Akhir</label>
                        <input type="text" required readonly name="proposal"
                            class="form-control  @error('proposal') is-invalid @enderror"
                            value="{{ old('proposal', @$gaji->proposal) }}">
                        @error('proposal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="ngujiTATotal">Total</label>
                        <input type="text" required name="ngujiTATotal"
                            class="form-control  @error('ngujiTATotal') is-invalid @enderror"
                            value="{{ old('ngujiTATotal') }}">
                        @error('ngujiTATotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="ngujiTA">Tugas Akhir</label>
                        <input type="text" required readonly name="ngujiTA"
                            class="form-control  @error('ngujiTA') is-invalid @enderror"
                            value="{{ old('ngujiTA', @$gaji->ngujiTA) }}">
                        @error('ngujiTA')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <hr>
            <div class="koreksi">
                <h5>Koreksi</h5>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="koreksiRegularTotal">Total</label>
                        <input type="text" required name="koreksiRegularTotal"
                            class="form-control  @error('koreksiRegularTotal') is-invalid @enderror"
                            value="{{ old('koreksiRegularTotal') }}">
                        @error('koreksiRegularTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="koreksiRegular">Regular</label>
                        <input type="text" required readonly name="koreksiRegular"
                            class="form-control  @error('koreksiRegular') is-invalid @enderror"
                            value="{{ old('koreksiRegular', @$gaji->koreksiRegular) }}">
                        @error('koreksiRegular')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="koreksiKaryawanTotal">Total</label>
                        <input type="text" required name="koreksiKaryawanTotal"
                            class="form-control  @error('koreksiKaryawanTotal') is-invalid @enderror"
                            value="{{ old('koreksiKaryawanTotal') }}">
                        @error('koreksiKaryawanTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="koreksiKaryawan">Karyawan</label>
                        <input type="text" required readonly name="koreksiKaryawan"
                            class="form-control  @error('koreksiKaryawan') is-invalid @enderror"
                            value="{{ old('koreksiKaryawan', @$gaji->koreksiKaryawan) }}">
                        @error('koreksiKaryawan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="koreksiInterTotal">Total</label>
                        <input type="text" required name="koreksiInterTotal"
                            class="form-control  @error('koreksiInterTotal') is-invalid @enderror"
                            value="{{ old('koreksiInterTotal') }}">
                        @error('koreksiInterTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="koreksiInter">International</label>
                        <input type="text" required readonly name="koreksiInter"
                            class="form-control  @error('koreksiInter') is-invalid @enderror"
                            value="{{ old('koreksiInter', @$gaji->koreksiInter) }}">
                        @error('koreksiInter')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <hr>
            <div class="soal">
                <h5>Soal</h5>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="soalRegularTotal">Total</label>
                        <input type="text" required name="soalRegularTotal"
                            class="form-control  @error('soalRegularTotal') is-invalid @enderror"
                            value="{{ old('soalRegularTotal') }}">
                        @error('soalRegularTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="soalRegular">Regular</label>
                        <input type="text" required readonly name="soalRegular"
                            class="form-control  @error('soalRegular') is-invalid @enderror"
                            value="{{ old('soalRegular', @$gaji->soalRegular) }}">
                        @error('soalRegular')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="soalKaryawanTotal">Total</label>
                        <input type="text" required name="soalKaryawanTotal"
                            class="form-control  @error('soalKaryawanTotal') is-invalid @enderror"
                            value="{{ old('soalKaryawanTotal') }}">
                        @error('soalKaryawanTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="soalKaryawan">Karyawan</label>
                        <input type="text" required readonly name="soalKaryawan"
                            class="form-control  @error('soalKaryawan') is-invalid @enderror"
                            value="{{ old('soalKaryawan', @$gaji->soalKaryawan) }}">
                        @error('soalKaryawan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="soalInterTotal">Total</label>
                        <input type="text" required name="soalInterTotal"
                            class="form-control  @error('soalInterTotal') is-invalid @enderror"
                            value="{{ old('soalInterTotal') }}">
                        @error('soalInterTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="soalInter">International</label>
                        <input type="text" required readonly name="soalInter"
                            class="form-control  @error('soalInter') is-invalid @enderror"
                            value="{{ old('soalInter', @$gaji->soalInter) }}">
                        @error('soalInter')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-row">
                <div class="form-group col">
                    <label for="dosenWaliTotal">Total</label>
                    <input type="text" required name="dosenWaliTotal"
                        class="form-control  @error('dosenWaliTotal') is-invalid @enderror"
                        value="{{ old('dosenWaliTotal') }}">
                    @error('dosenWaliTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="dosenWali">Dosen Wali</label>
                    <input type="text" required readonly name="dosenWali"
                        class="form-control  @error('dosenWali') is-invalid @enderror"
                        value="{{ old('dosenWali', @$gaji->dosenWali) }}">
                    @error('dosenWali')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="pengawasTotal">Total</label>
                    <input type="text" required name="pengawasTotal"
                        class="form-control  @error('pengawasTotal') is-invalid @enderror"
                        value="{{ old('pengawasTotal') }}">
                    @error('pengawasTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="pengawas">Pengawas</label>
                    <input type="text" required readonly name="pengawas"
                        class="form-control  @error('pengawas') is-invalid @enderror"
                        value="{{ old('pengawas', @$gaji->pengawas) }}">
                    @error('pengawas')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="lemburPengawasTotal">Total</label>
                    <input type="text" required name="lemburPengawasTotal"
                        class="form-control  @error('lemburPengawasTotal') is-invalid @enderror"
                        value="{{ old('lemburPengawasTotal') }}">
                    @error('lemburPengawasTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="lemburPengawas">Lembur Pengawas</label>
                    <input type="text" required readonly name="lemburPengawas"
                        class="form-control  @error('lemburPengawas') is-invalid @enderror"
                        value="{{ old('lemburPengawas', @$gaji->lemburPengawas) }}">
                    @error('lemburPengawas')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="koorTotal">Total</label>
                    <input type="text" required name="koorTotal"
                        class="form-control  @error('koorTotal') is-invalid @enderror" value="{{ old('koorTotal') }}">
                    @error('koorTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="koor">Koor Mata Kuliah</label>
                    <input type="text" required readonly name="koor"
                        class="form-control  @error('koor') is-invalid @enderror"
                        value="{{ old('koor', @$gaji->koor) }}">
                    @error('koor')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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