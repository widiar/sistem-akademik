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
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="mengajar">Mengajar</label>
                        <input type="number" required readonly name="mengajar"
                            class="form-control  @error('mengajar') is-invalid @enderror"
                            value="{{ old('mengajar', @$gaji->mengajar) }}">
                        @error('mengajar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="transport">Transport</label>
                        <input type="number" required readonly name="transport"
                            class="form-control  @error('transport') is-invalid @enderror"
                            value="{{ old('transport', @$gaji->transport) }}">
                        @error('transport')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    @php
                    $waliTotal = 0;
                    if($wali){
                    if($ganjil == TRUE)
                    $waliTotal = @json_decode($wali->pivot->semester_ganjil)->ganjil;
                    else $waliTotal = @json_decode($wali->pivot->semester_genap)->genap;
                    }else $waliTotal = $gaji->waliTotal;
                    @endphp
                    <label for="waliTotal">Total</label>
                    <input type="number" required name="waliTotal"
                        class="form-control  @error('waliTotal') is-invalid @enderror"
                        value="{{ old('waliTotal', $waliTotal) }}">
                    @error('waliTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="wali">Dosen Wali</label>
                    <input type="number" required readonly name="wali"
                        class="form-control  @error('wali') is-invalid @enderror"
                        value="{{ old('wali', @$gaji->wali) }}">
                    @error('wali')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <h4>Honor Mengajar: </h4>
            <div class="form-row">
                <div class="form-group col">
                    <label for="absen">Absen</label>
                    <input type="number" required readonly name="absen"
                        class="form-control  @error('absen') is-invalid @enderror"
                        value="{{ old('absen', @$absen->count()) }}">
                    @error('absen')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="regular">Regular</label>
                    <input type="number" required readonly name="regular"
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
                    <input type="number" required name="karyawanTotal"
                        class="form-control  @error('karyawanTotal') is-invalid @enderror"
                        value="{{ old('karyawanTotal', @$gaji->karyawanTotal) }}">
                    @error('karyawanTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="karyawan">Karyawan</label>
                    <input type="number" required readonly name="karyawan"
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
                    <input type="number" required name="eksekutifTotal"
                        class="form-control  @error('eksekutifTotal') is-invalid @enderror"
                        value="{{ old('eksekutifTotal', @$gaji->eksekutifTotal) }}">
                    @error('eksekutifTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="eksekutif">Eksekutif / Smt Pendek</label>
                    <input type="number" required readonly name="eksekutif"
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
                    <input type="number" required name="interTeoriTotal"
                        class="form-control  @error('interTeoriTotal') is-invalid @enderror"
                        value="{{ old('interTeoriTotal', @$gaji->interTeoriTotal) }}">
                    @error('interTeoriTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="interTeori">International Teori</label>
                    <input type="number" required readonly name="interTeori"
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
                    <input type="number" required name="interPraktekTotal"
                        class="form-control  @error('interPraktekTotal') is-invalid @enderror"
                        value="{{ old('interPraktekTotal', @$gaji->interPraktekTotal) }}">
                    @error('interPraktekTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="interPraktek">International Praktek</label>
                    <input type="number" required readonly name="interPraktek"
                        class="form-control  @error('interPraktek') is-invalid @enderror"
                        value="{{ old('interPraktek', @$gaji->interPraktek) }}">
                    @error('interPraktek')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    @php
                    $kerjaPraktek = 0;
                    if($kp){
                    if($ganjil == TRUE) $kerjaPraktek = @json_decode($kp->pivot->semester_ganjil)->ganjil;
                    else $kerjaPraktek = @json_decode($kp->pivot->semester_genap)->genap;
                    }else $kerjaPraktek = $gaji->kerjaPraktekTotal;
                    @endphp
                    <label for="kerjaPraktekTotal">Total</label>
                    <input type="number" required name="kerjaPraktekTotal"
                        class="form-control  @error('kerjaPraktekTotal') is-invalid @enderror"
                        value="{{ old('kerjaPraktekTotal', $kerjaPraktek) }}">
                    @error('kerjaPraktekTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="kerjaPraktek">Kerja Praktek</label>
                    <input type="number" required readonly name="kerjaPraktek"
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
                    @php
                    $skripsi1 = 0;
                    if($skripsi){
                    if($ganjil == TRUE) $skripsi1 = @json_decode($skripsi->pivot->semester_ganjil)->skripsi1;
                    else $skripsi1 = @json_decode($skripsi->pivot->semester_genap)->skripsi1;
                    }else $skripsi1 = $gaji->skripsi1Total;
                    @endphp
                    <label for="skripsi1Total">Total</label>
                    <input type="number" required name="skripsi1Total"
                        class="form-control  @error('skripsi1Total') is-invalid @enderror"
                        value="{{ old('skripsi1Total', $skripsi1) }}">
                    @error('skripsi1Total')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="skripsi1">Skripsi I</label>
                    <input type="number" required readonly name="skripsi1"
                        class="form-control  @error('skripsi1') is-invalid @enderror"
                        value="{{ old('skripsi1', @$gaji->skripsi1) }}">
                    @error('skripsi1')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    @php
                    $skripsi2 = 0;
                    if($skripsi)
                    {if($ganjil == TRUE) $skripsi2 = @json_decode($skripsi->pivot->semester_ganjil)->skripsi2;
                    else $skripsi2 = @json_decode($skripsi->pivot->semester_genap)->skripsi2;
                    }else $skripsi2 = $gaji->skripsi2Total;
                    @endphp
                    <label for="skripsi2Total">Total</label>
                    <input type="number" required name="skripsi2Total"
                        class="form-control  @error('skripsi2Total') is-invalid @enderror"
                        value="{{ old('skripsi2Total', $skripsi2) }}">
                    @error('skripsi2Total')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="skripsi2">Skripsi II</label>
                    <input type="number" required readonly name="skripsi2"
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
                        @php
                        $ta1 = 0;
                        if($ta){
                        if($ganjil == TRUE) $ta1 = @json_decode($ta->pivot->semester_ganjil)->ta1;
                        else $ta1 = @json_decode($ta->pivot->semester_genap)->ta1;
                        }else $ta1 = $gaji->ta1Total;
                        @endphp
                        <label for="ta1Total">Total</label>
                        <input type="number" required name="ta1Total"
                            class="form-control  @error('ta1Total') is-invalid @enderror"
                            value="{{ old('ta1Total', $ta1) }}">
                        @error('ta1Total')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="ta1">Tugas Akhir I</label>
                        <input type="number" required readonly name="ta1"
                            class="form-control  @error('ta1') is-invalid @enderror"
                            value="{{ old('ta1', @$gaji->ta1) }}">
                        @error('ta1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        @php
                        $ta2 = 0;
                        if($ta){
                        if($ganjil == TRUE) $ta2 = @json_decode($ta->pivot->semester_ganjil)->ta2;
                        else $ta2 = @json_decode($ta->pivot->semester_genap)->ta2;
                        }else $ta2 = $gaji->ta2Total;
                        @endphp
                        <label for="ta2Total">Total</label>
                        <input type="number" required name="ta2Total"
                            class="form-control  @error('ta2Total') is-invalid @enderror"
                            value="{{ old('ta2Total', $ta2) }}">
                        @error('ta2Total')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="ta2">Tugas Akhir II</label>
                        <input type="number" required readonly name="ta2"
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
                        <input type="number" required name="seminarSkripsiTotal"
                            class="form-control  @error('seminarSkripsiTotal') is-invalid @enderror"
                            value="{{ old('seminarSkripsiTotal', @$gaji->seminarSkripsiTotal) }}">
                        @error('seminarSkripsiTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="seminarSkripsi">Seminar Skripsi</label>
                        <input type="number" required readonly name="seminarSkripsi"
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
                        <input type="number" required name="seminarTerbukaTotal"
                            class="form-control  @error('seminarTerbukaTotal') is-invalid @enderror"
                            value="{{ old('seminarTerbukaTotal', @$gaji->seminarTerbukaTotal) }}">
                        @error('seminarTerbukaTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="seminarTerbuka">Seminar Terbuka</label>
                        <input type="number" required readonly name="seminarTerbuka"
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
                        <input type="number" required name="proposalTotal"
                            class="form-control  @error('proposalTotal') is-invalid @enderror"
                            value="{{ old('proposalTotal', @$gaji->proposalTotal) }}">
                        @error('proposalTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="proposal">Proposal Tugas Akhir</label>
                        <input type="number" required readonly name="proposal"
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
                        <input type="number" required name="ngujiTATotal"
                            class="form-control  @error('ngujiTATotal') is-invalid @enderror"
                            value="{{ old('ngujiTATotal', @$gaji->ngujiTATotal) }}">
                        @error('ngujiTATotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="ngujiTA">Tugas Akhir</label>
                        <input type="number" required readonly name="ngujiTA"
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
                        <input type="number" required name="koreksiRegularTotal"
                            class="form-control  @error('koreksiRegularTotal') is-invalid @enderror"
                            value="{{ old('koreksiRegularTotal', @$gaji->koreksiRegularTotal) }}">
                        @error('koreksiRegularTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="koreksiRegular">Regular</label>
                        <input type="number" required readonly name="koreksiRegular"
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
                        <input type="number" required name="koreksiKaryawanTotal"
                            class="form-control  @error('koreksiKaryawanTotal') is-invalid @enderror"
                            value="{{ old('koreksiKaryawanTotal', @$gaji->koreksiKaryawanTotal) }}">
                        @error('koreksiKaryawanTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="koreksiKaryawan">Karyawan</label>
                        <input type="number" required readonly name="koreksiKaryawan"
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
                        <input type="number" required name="koreksiInterTotal"
                            class="form-control  @error('koreksiInterTotal') is-invalid @enderror"
                            value="{{ old('koreksiInterTotal', @$gaji->koreksiInterTotal) }}">
                        @error('koreksiInterTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="koreksiInter">International</label>
                        <input type="number" required readonly name="koreksiInter"
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
                        <input type="number" required name="soalRegularTotal"
                            class="form-control  @error('soalRegularTotal') is-invalid @enderror"
                            value="{{ old('soalRegularTotal', @$gaji->soalRegularTotal) }}">
                        @error('soalRegularTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="soalRegular">Regular</label>
                        <input type="number" required readonly name="soalRegular"
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
                        <input type="number" required name="soalKaryawanTotal"
                            class="form-control  @error('soalKaryawanTotal') is-invalid @enderror"
                            value="{{ old('soalKaryawanTotal', @$gaji->soalKaryawanTotal) }}">
                        @error('soalKaryawanTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="soalKaryawan">Karyawan</label>
                        <input type="number" required readonly name="soalKaryawan"
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
                        <input type="number" required name="soalInterTotal"
                            class="form-control  @error('soalInterTotal') is-invalid @enderror"
                            value="{{ old('soalInterTotal', @$gaji->soalInterTotal) }}">
                        @error('soalInterTotal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="soalInter">International</label>
                        <input type="number" required readonly name="soalInter"
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
                    <label for="pengawasTotal">Total</label>
                    <input type="number" required name="pengawasTotal"
                        class="form-control  @error('pengawasTotal') is-invalid @enderror"
                        value="{{ old('pengawasTotal', @$gaji->pengawasTotal) }}">
                    @error('pengawasTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="pengawas">Pengawas</label>
                    <input type="number" required readonly name="pengawas"
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
                    <input type="number" required name="lemburPengawasTotal"
                        class="form-control  @error('lemburPengawasTotal') is-invalid @enderror"
                        value="{{ old('lemburPengawasTotal', @$gaji->lemburPengawasTotal) }}">
                    @error('lemburPengawasTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="lemburPengawas">Lembur Pengawas</label>
                    <input type="number" required readonly name="lemburPengawas"
                        class="form-control  @error('lemburPengawas') is-invalid @enderror"
                        value="{{ old('lemburPengawas', @$gaji->lemburPengawas) }}">
                    @error('lemburPengawas')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    @php
                    $koordinator = 0;
                    if($koor){
                    if($ganjil == TRUE) $koordinator = @json_decode($koor->pivot->semester_ganjil)->ganjil;
                    else $koordinator = @json_decode($koor->pivot->semester_genap)->genap;
                    }else $koordinator = $gaji->koorTotal;
                    @endphp
                    <label for="koorTotal">Total</label>
                    <input type="number" required name="koorTotal"
                        class="form-control  @error('koorTotal') is-invalid @enderror"
                        value="{{ old('koorTotal', $koordinator) }}">
                    @error('koorTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col">
                    <label for="koor">Koor Mata Kuliah</label>
                    <input type="number" required readonly name="koor"
                        class="form-control  @error('koor') is-invalid @enderror"
                        value="{{ old('koor', @$gaji->koor) }}">
                    @error('koor')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <h3>Total Gaji : Rp. <span id="gaji-total"></span></h3>
            <input type="hidden" name="gajiTotal">
            <div class="float-right">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function(){
        let gajiTotal
        initTotal()
        $("input[type='number']").change(initTotal)

        $(".form-gaji").submit(function(e){
            $("input[name='gajiTotal']").val(gajiTotal)
            return true
        })

        function initTotal()
        {
            let total = []

            let mengajar = parseInt($("input[name='mengajar']").val())
            let transport = parseInt($("input[name='transport']").val())
            total.push(mengajar, transport)

            let waliTotal = parseInt($("input[name='waliTotal']").val()) || 0
            let wali = parseInt($("input[name='wali']").val())
            let gajiWali = wali * waliTotal
            total.push(gajiWali)

            let absen = parseInt($("input[name='absen']").val())
            let regular = parseInt($("input[name='regular']").val())
            let gajiRegular = absen * regular
            total.push(gajiRegular)

            let karyawanTotal = parseInt($("input[name='karyawanTotal']").val()) || 0
            let karyawan = parseInt($("input[name='karyawan']").val())
            let gajiKaryawan = karyawanTotal * karyawan
            total.push(gajiKaryawan)

            let eksekutifTotal = parseInt($("input[name='eksekutifTotal']").val()) || 0
            let eksekutif = parseInt($("input[name='eksekutif']").val())
            let gajiEksekutif = eksekutifTotal * eksekutif
            total.push(gajiEksekutif)

            let interTeoriTotal = parseInt($("input[name='interTeoriTotal']").val()) || 0
            let interTeori = parseInt($("input[name='interTeori']").val())
            let gajiInterTeori = interTeoriTotal * interTeori
            total.push(gajiInterTeori)

            let interPraktekTotal = parseInt($("input[name='interPraktekTotal']").val()) || 0
            let interPraktek = parseInt($("input[name='interPraktek']").val())
            let gajiInterPraktek = interPraktekTotal * interPraktek
            total.push(gajiInterPraktek)

            let kerjaPraktekTotal = parseInt($("input[name='kerjaPraktekTotal']").val()) || 0
            let kerjaPraktek = parseInt($("input[name='kerjaPraktek']").val())
            let gajiKerjaPraktek = kerjaPraktekTotal * kerjaPraktek
            total.push(gajiKerjaPraktek)

            let skripsi1Total = parseInt($("input[name='skripsi1Total']").val()) || 0
            let skripsi1 = parseInt($("input[name='skripsi1']").val())
            let gajiSkripsi1 = skripsi1Total * skripsi1
            total.push(gajiSkripsi1)

            let skripsi2Total = parseInt($("input[name='skripsi2Total']").val()) || 0
            let skripsi2 = parseInt($("input[name='skripsi2']").val())
            let gajiSkripsi2 = skripsi2Total * skripsi2
            total.push(gajiSkripsi2)

            let ta1Total = parseInt($("input[name='ta1Total']").val()) || 0
            let ta1 = parseInt($("input[name='ta1']").val())
            let gajita1 = ta1Total * ta1
            total.push(gajita1)

            let ta2Total = parseInt($("input[name='ta2Total']").val()) || 0
            let ta2 = parseInt($("input[name='ta2']").val())
            let gajita2 = ta2Total * ta2
            total.push(gajita2)

            let seminarSkripsiTotal = parseInt($("input[name='seminarSkripsiTotal']").val()) || 0
            let seminarSkripsi = parseInt($("input[name='seminarSkripsi']").val())
            let gajiseminarSkripsi = seminarSkripsiTotal * seminarSkripsi
            total.push(gajiseminarSkripsi)

            let seminarTerbukaTotal = parseInt($("input[name='seminarTerbukaTotal']").val()) || 0
            let seminarTerbuka = parseInt($("input[name='seminarTerbuka']").val())
            let gajiseminarTerbuka = seminarTerbukaTotal * seminarTerbuka
            total.push(gajiseminarTerbuka)

            let proposalTotal = parseInt($("input[name='proposalTotal']").val()) || 0
            let proposal = parseInt($("input[name='proposal']").val())
            let gajiproposal = proposalTotal * proposal
            total.push(gajiproposal)

            let ngujiTATotal = parseInt($("input[name='ngujiTATotal']").val()) || 0
            let ngujiTA = parseInt($("input[name='ngujiTA']").val())
            let gajingujiTA = ngujiTATotal * ngujiTA
            total.push(gajingujiTA)

            let koreksiRegularTotal = parseInt($("input[name='koreksiRegularTotal']").val()) || 0
            let koreksiRegular = parseInt($("input[name='koreksiRegular']").val()) || 0
            let gajikoreksiRegular = koreksiRegularTotal * koreksiRegular
            total.push(gajikoreksiRegular)

            let koreksiKaryawanTotal = parseInt($("input[name='koreksiKaryawanTotal']").val()) || 0
            let koreksiKaryawan = parseInt($("input[name='koreksiKaryawan']").val())
            let gajikoreksiKaryawan = koreksiKaryawanTotal * koreksiKaryawan
            total.push(gajikoreksiKaryawan)

            let koreksiInterTotal = parseInt($("input[name='koreksiInterTotal']").val()) || 0
            let koreksiInter = parseInt($("input[name='koreksiInter']").val())
            let gajikoreksiInter = koreksiInterTotal * koreksiInter
            total.push(gajikoreksiInter)

            let soalRegularTotal = parseInt($("input[name='soalRegularTotal']").val()) || 0
            let soalRegular = parseInt($("input[name='soalRegular']").val())
            let gajisoalRegular = soalRegularTotal * soalRegular
            total.push(gajisoalRegular)

            let soalKaryawanTotal = parseInt($("input[name='soalKaryawanTotal']").val()) || 0
            let soalKaryawan = parseInt($("input[name='soalKaryawan']").val())
            let gajisoalKaryawan = soalKaryawanTotal * soalKaryawan
            total.push(gajisoalKaryawan)

            let soalInterTotal = parseInt($("input[name='soalInterTotal']").val()) || 0
            let soalInter = parseInt($("input[name='soalInter']").val())
            let gajisoalInter = soalInterTotal * soalInter
            total.push(gajisoalInter)

            let pengawasTotal = parseInt($("input[name='pengawasTotal']").val()) || 0
            let pengawas = parseInt($("input[name='pengawas']").val())
            let gajipengawas = pengawasTotal * pengawas
            total.push(gajipengawas)

            let lemburPengawasTotal = parseInt($("input[name='lemburPengawasTotal']").val()) || 0
            let lemburPengawas = parseInt($("input[name='lemburPengawas']").val())
            let gajilemburPengawas = lemburPengawasTotal * lemburPengawas
            total.push(gajilemburPengawas)

            let koorTotal = parseInt($("input[name='koorTotal']").val()) || 0
            let koor = parseInt($("input[name='koor']").val())
            let gajikoor = koorTotal * koor
            total.push(gajikoor)

            gajiTotal = total.reduce((a,b) => a + b)

            $("#gaji-total").text(gajiTotal)
            $("#gaji-total").simpleMoneyFormat()
        }
    })
</script>
@endsection