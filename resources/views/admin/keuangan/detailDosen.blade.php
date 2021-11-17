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
                    if(isset($gaji->gajiTotal)) $waliTotal = $gaji->waliTotal;
                    else $waliTotal = $pegawai->dosen[0]->wali;
                    @endphp
                    <label for="waliTotal">Total</label>
                    <input type="number" required name="waliTotal"
                        class="form-control  @error('waliTotal') is-invalid @enderror"
                        value="{{ old('waliTotal', @$waliTotal) }}">
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
                    @php
                    if(isset($gaji->gajiTotal)) $regularTotal = $gaji->absen;
                    else $regularTotal = $regular->count();
                    @endphp
                    <label for="absen">Absen</label>
                    <input type="number" required name="absen"
                        class="form-control  @error('absen') is-invalid @enderror"
                        value="{{ old('absen', @$regularTotal) }}">
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
                    @php
                    if(isset($gaji->gajiTotal)) $karyawanTotal = $gaji->karyawanTotal;
                    else $karyawanTotal = $karyawan->count();
                    @endphp
                    <label for="karyawanTotal">Total</label>
                    <input type="number" required name="karyawanTotal"
                        class="form-control  @error('karyawanTotal') is-invalid @enderror"
                        value="{{ old('karyawanTotal', @$karyawanTotal) }}">
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
                    @php
                    if(isset($gaji->gajiTotal)) $eksekutifTotal = $gaji->eksekutifTotal;
                    else $eksekutifTotal = $eksekutif->count();
                    @endphp
                    <label for="eksekutifTotal">Total</label>
                    <input type="number" required name="eksekutifTotal"
                        class="form-control  @error('eksekutifTotal') is-invalid @enderror"
                        value="{{ old('eksekutifTotal', @$eksekutifTotal) }}">
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
                    @php
                    if(isset($gaji->gajiTotal)) $interTeoriTotal = $gaji->interTeoriTotal;
                    else $interTeoriTotal = $interTeori->count();
                    @endphp
                    <input type="number" required name="interTeoriTotal"
                        class="form-control  @error('interTeoriTotal') is-invalid @enderror"
                        value="{{ old('interTeoriTotal', @$interTeoriTotal) }}">
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
                    @php
                    if(isset($gaji->gajiTotal)) $interPraktekTotal = $gaji->interPraktekTotal;
                    else $interPraktekTotal = $interPraktek->count();
                    @endphp
                    <label for="interPraktekTotal">Total</label>
                    <input type="number" required name="interPraktekTotal"
                        class="form-control  @error('interPraktekTotal') is-invalid @enderror"
                        value="{{ old('interPraktekTotal', @$interPraktekTotal) }}">
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
                    if(isset($gaji->gajiTotal)) $kerjaPraktekTotal = $gaji->kerjaPraktekTotal;
                    else $kerjaPraktekTotal = $pegawai->dosen[0]->kerja_praktek;
                    @endphp
                    <label for="kerjaPraktekTotal">Total</label>
                    <input type="number" required name="kerjaPraktekTotal"
                        class="form-control  @error('kerjaPraktekTotal') is-invalid @enderror"
                        value="{{ old('kerjaPraktekTotal', @$kerjaPraktekTotal) }}">
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
                <div class="form-group col-6 col-md-3">
                    @php
                    if(isset($gaji->gajiTotal)) $skripsi2Pembimbing1Total = $gaji->skripsi2Pembimbing1Total;
                    else $skripsi2Pembimbing1Total = $pegawai->dosen[0]->skripsi_2_pembimbing_1;
                    @endphp
                    <label for="skripsi2Pembimbing1Total">Total Pembimbing 1</label>
                    <input type="number" required name="skripsi2Pembimbing1Total"
                        class="form-control  @error('skripsi2Pembimbing1Total') is-invalid @enderror"
                        value="{{ old('skripsi2Pembimbing1Total', @$skripsi2Pembimbing1Total) }}">
                    @error('skripsi2Pembimbing1Total')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-6 col-md-3">
                    <label for="skripsi2Pembimbing1">Pembimbing 1</label>
                    <input type="number" required readonly name="skripsi2Pembimbing1"
                        class="form-control  @error('skripsi2Pembimbing1') is-invalid @enderror"
                        value="{{ old('skripsi2Pembimbing1', @$gaji->skripsi2Pembimbing1) }}">
                    @error('skripsi2Pembimbing1')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-6 col-md-3">
                    @php
                    if(isset($gaji->gajiTotal)) $skripsi2Pembimbing2Total = $gaji->skripsi2Pembimbing2Total;
                    else $skripsi2Pembimbing2Total = $pegawai->dosen[0]->skripsi_2_pembimbing_2;
                    @endphp
                    <label for="skripsi2Pembimbing2Total">Total Pembimbing 2</label>
                    <input type="number" required name="skripsi2Pembimbing2Total"
                        class="form-control  @error('skripsi2Pembimbing2Total') is-invalid @enderror"
                        value="{{ old('skripsi2Pembimbing2Total', @$skripsi2Pembimbing2Total) }}">
                    @error('skripsi2Pembimbing2Total')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-6 col-md-3">
                    <label for="skripsi2Pembimbing2">Pembimbing 2</label>
                    <input type="number" required readonly name="skripsi2Pembimbing2"
                        class="form-control  @error('skripsi2Pembimbing2') is-invalid @enderror"
                        value="{{ old('skripsi2Pembimbing2', @$gaji->skripsi2Pembimbing2) }}">
                    @error('skripsi2Pembimbing2')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <hr>
            <div class="ta">
                <h5>Tugas Akhir</h5>
                <div class="form-row">
                    <div class="form-group col-6 col-md-3">
                        @php
                        if(isset($gaji->gajiTotal)) $ta2Pembimbing1Total = $gaji->ta2Pembimbing1Total;
                        else $ta2Pembimbing1Total = $pegawai->dosen[0]->tugas_akhir_2_pembimbing_1;
                        @endphp
                        <label for="ta2Pembimbing1Total">Total Pembimbing 1</label>
                        <input type="number" required name="ta2Pembimbing1Total"
                            class="form-control  @error('ta2Pembimbing1Total') is-invalid @enderror"
                            value="{{ old('ta2Pembimbing1Total', @$ta2Pembimbing1Total) }}">
                        @error('ta2Pembimbing1Total')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-6 col-md-3">
                        <label for="ta2Pembimbing1">Pembimbing 1</label>
                        <input type="number" required readonly name="ta2Pembimbing1"
                            class="form-control  @error('ta2Pembimbing1') is-invalid @enderror"
                            value="{{ old('ta2Pembimbing1', @$gaji->ta2Pembimbing1) }}">
                        @error('ta2Pembimbing1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-6 col-md-3">
                        @php
                        if(isset($gaji->gajiTotal)) $ta2Pembimbing2Total = $gaji->ta2Pembimbing2Total;
                        else $ta2Pembimbing2Total = $pegawai->dosen[0]->tugas_akhir_2_pembimbing_2;
                        @endphp
                        <label for="ta2Pembimbing2Total">Total Pembimbing 2</label>
                        <input type="number" required name="ta2Pembimbing2Total"
                            class="form-control  @error('ta2Pembimbing2Total') is-invalid @enderror"
                            value="{{ old('ta2Pembimbing2Total', @$ta2Pembimbing2Total) }}">
                        @error('ta2Pembimbing2Total')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-6 col-md-3">
                        <label for="ta2Pembimbing2">Pembimbing 2</label>
                        <input type="number" required readonly name="ta2Pembimbing2"
                            class="form-control  @error('ta2Pembimbing2') is-invalid @enderror"
                            value="{{ old('ta2Pembimbing2', @$gaji->ta2Pembimbing2) }}">
                        @error('ta2Pembimbing2')
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
                        @php
                        if(isset($gaji->gajiTotal)) $seminarSkripsiTotal = $gaji->seminarSkripsiTotal;
                        else $seminarSkripsiTotal = $pegawai->dosen[0]->penguji_seminar_skripsi;
                        @endphp
                        <label for="seminarSkripsiTotal">Total</label>
                        <input type="number" required name="seminarSkripsiTotal"
                            class="form-control  @error('seminarSkripsiTotal') is-invalid @enderror"
                            value="{{ old('seminarSkripsiTotal', @$seminarSkripsiTotal) }}">
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
                        @php
                        if(isset($gaji->gajiTotal)) $seminarTerbukaTotal = $gaji->seminarTerbukaTotal;
                        else $seminarTerbukaTotal = $pegawai->dosen[0]->penguji_seminar_terbuka;
                        @endphp
                        <label for="seminarTerbukaTotal">Total</label>
                        <input type="number" required name="seminarTerbukaTotal"
                            class="form-control  @error('seminarTerbukaTotal') is-invalid @enderror"
                            value="{{ old('seminarTerbukaTotal', @$seminarTerbukaTotal) }}">
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
                        @php
                        if(isset($gaji->gajiTotal)) $proposalTotal = $gaji->proposalTotal;
                        else $proposalTotal = $pegawai->dosen[0]->penguji_proposal_TA;
                        @endphp
                        <label for="proposalTotal">Total</label>
                        <input type="number" required name="proposalTotal"
                            class="form-control  @error('proposalTotal') is-invalid @enderror"
                            value="{{ old('proposalTotal', @$proposalTotal) }}">
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
                        @php
                        if(isset($gaji->gajiTotal)) $ngujiTATotal = $gaji->ngujiTATotal;
                        else $ngujiTATotal = $pegawai->dosen[0]->penguji_tugas_akhir;
                        @endphp
                        <label for="ngujiTATotal">Total</label>
                        <input type="number" required name="ngujiTATotal"
                            class="form-control  @error('ngujiTATotal') is-invalid @enderror"
                            value="{{ old('ngujiTATotal', @$ngujiTATotal) }}">
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
                    if(isset($gaji->gajiTotal)) $koorTotal = $gaji->koorTotal;
                    else $koorTotal = $pegawai->koordinator[0]->jumlah;
                    @endphp
                    <label for="koorTotal">Total</label>
                    <input type="number" required name="koorTotal"
                        class="form-control  @error('koorTotal') is-invalid @enderror"
                        value="{{ old('koorTotal', @$koorTotal) }}">
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
        $("input[type='number']").keyup(initTotal)

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

            // let skripsi1Total = parseInt($("input[name='skripsi1Total']").val()) || 0
            // let skripsi1 = parseInt($("input[name='skripsi1']").val())
            // let gajiSkripsi1 = skripsi1Total * skripsi1
            // total.push(gajiSkripsi1)

            let skripsi2Pembimbing1Total = parseInt($("input[name='skripsi2Pembimbing1Total']").val()) || 0
            let skripsi2Pembimbing1 = parseInt($("input[name='skripsi2Pembimbing1']").val())
            let gajiSkripsi2 = skripsi2Pembimbing1Total * skripsi2Pembimbing1
            total.push(gajiSkripsi2)

            let skripsi2Pembimbing2Total = parseInt($("input[name='skripsi2Pembimbing2Total']").val()) || 0
            let skripsi2Pembimbing2 = parseInt($("input[name='skripsi2Pembimbing2']").val())
            let gajiSkripsi2p2 = skripsi2Pembimbing2Total * skripsi2Pembimbing1
            total.push(gajiSkripsi2p2)

            // let ta1Total = parseInt($("input[name='ta1Total']").val()) || 0
            // let ta1 = parseInt($("input[name='ta1']").val())
            // let gajita1 = ta1Total * ta1
            // total.push(gajita1)

            let ta2Pembimbing1Total = parseInt($("input[name='ta2Pembimbing1Total']").val()) || 0
            let ta2Pembimbing1 = parseInt($("input[name='ta2Pembimbing1']").val())
            let gajita2 = ta2Pembimbing1Total * ta2Pembimbing1
            total.push(gajita2)

            let ta2Pembimbing2Total = parseInt($("input[name='ta2Pembimbing2Total']").val()) || 0
            let ta2Pembimbing2 = parseInt($("input[name='ta2Pembimbing2']").val())
            let gajita2p2 = ta2Pembimbing2Total * ta2Pembimbing2
            total.push(gajita2p2)

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