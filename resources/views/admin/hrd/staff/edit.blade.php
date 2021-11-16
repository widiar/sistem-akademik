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
                    value="{{ old('nip', @$data->nip) }}">
                @error('nip')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control  @error('nama') is-invalid @enderror"
                    value="{{ old('nama', @$data->nama) }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror"
                    value="{{ old('email', @$data->email) }}">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                @php
                $jabatan = [];
                if ($data->is_dosen) array_push($jabatan, "dosen");
                if ($data->is_staff) array_push($jabatan, "staff");
                @endphp
                <label for="kategori">Jabatan</label>
                <select name="jabatan[]" multiple="multiple"
                    class="jabatan w-100  @error('jabatan') is-invalid @enderror" style="width: 100%">
                    <option {{ (is_array(old('jabatan', @$jabatan)) && in_array("dosen", old('jabatan', @$jabatan)))
                        ? ' selected' : '' }} value="dosen">Dosen</option>
                    <option {{ (is_array(old('jabatan', @$jabatan)) && in_array("staff", old('jabatan', @$jabatan)))
                        ? ' selected' : '' }} value="staff">Staff</option>
                </select>
                @error('jabatan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="staff" style="display: none">
                <div class="form-group">
                    @php
                    $jabatanStaff = [];
                    if($data->staff)
                    foreach($data->staff as $st){
                    array_push($jabatanStaff, $st->jabatan);
                    }
                    @endphp
                    <label for="kategori">Jabatan Staff</label>
                    <select name="jabatanStaff[]" multiple="multiple"
                        class="jabatanStaff w-100  @error('jabatanStaff') is-invalid @enderror" style="width: 100%">
                        <option {{ (is_array(old('jabatanStaff', $jabatanStaff)) && in_array("akademik",
                            old('jabatanStaff', $jabatanStaff))) ? ' selected' : '' }} value="akademik">Akademik
                        </option>
                        <option {{ (is_array(old('jabatanStaff', $jabatanStaff)) && in_array("keuangan",
                            old('jabatanStaff', $jabatanStaff))) ? ' selected' : '' }} value="keuangan">Keuangan
                        </option>
                        <option {{ (is_array(old('jabatanStaff', $jabatanStaff)) && in_array("pemasaran",
                            old('jabatanStaff', $jabatanStaff))) ? ' selected' : '' }} value="pemasaran">Pemasaran
                        </option>
                    </select>
                    @error('jabatanStaff')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <h3>Gaji Staff</h3>
                <hr>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="gaji">Gaji Pokok</label>
                            <input type="text" name="gaji" class="form-control  @error('gaji') is-invalid @enderror"
                                value="{{ old('gaji', @$data->detailStaff->gaji) }}">
                            @error('gaji')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="lembur">Lembur</label>
                            <input type="text" name="lembur" class="form-control  @error('lembur') is-invalid @enderror"
                                value="{{ old('lembur', @$data->detailStaff->lembur) }}">
                            @error('lembur')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> --}}
                </div>
                <h4>Tunjangan: </h4>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="makan">Uang Makan dan Transport</label>
                            <input type="text" name="makan" class="form-control  @error('makan') is-invalid @enderror"
                                value="{{ old('makan', @$data->detailStaff->makan) }}">
                            @error('makan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatanGaji"
                                class="form-control  @error('jabatanGaji') is-invalid @enderror"
                                value="{{ old('jabatanGaji', @$data->detailStaff->jabatan) }}">
                            @error('jabatanGaji')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="keahlian">Keahlian</label>
                            <input type="text" name="keahlian"
                                class="form-control  @error('keahlian') is-invalid @enderror"
                                value="{{ old('keahlian', @$data->detailStaff->keahlian) }}">
                            @error('keahlian')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="pulsa">Pulsa</label>
                            <input type="text" name="pulsa" class="form-control  @error('pulsa') is-invalid @enderror"
                                value="{{ old('pulsa', @$data->detailStaff->pulsa) }}">
                            @error('pulsa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="tol">Tol / Bensin</label>
                            <input type="text" name="tol" class="form-control  @error('tol') is-invalid @enderror"
                                value="{{ old('tol', @$data->detailStaff->tol) }}">
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
                            <input type="text" name="kurangGaji"
                                class="form-control  @error('kurangGaji') is-invalid @enderror"
                                value="{{ old('kurangGaji', @$data->detailStaff->kurang_gaji) }}">
                            @error('kurangGaji')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="reward">Reward</label>
                            <input type="text" name="reward" class="form-control  @error('reward') is-invalid @enderror"
                                value="{{ old('reward', @$data->detailStaff->reward) }}">
                            @error('reward')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="thr">THR</label>
                            <input type="text" name="thr" class="form-control  @error('thr') is-invalid @enderror"
                                value="{{ old('thr', @$data->detailStaff->thr) }}">
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
                            <input type="text" name="bpjsKesehatan"
                                class="form-control  @error('bpjsKesehatan') is-invalid @enderror"
                                value="{{ old('bpjsKesehatan', @$data->detailStaff->bpjs_kesehatan) }}">
                            @error('bpjsKesehatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="bpjsKerja">BPJS Ketenagakerjaan</label>
                            <input type="text" name="bpjsKerja"
                                class="form-control  @error('bpjsKerja') is-invalid @enderror"
                                value="{{ old('bpjsKerja', @$data->detailStaff->bpjs_kerja) }}">
                            @error('bpjsKerja')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="no_finger">No Finger</label>
                            <input type="text" name="no_finger"
                                class="form-control  @error('no_finger') is-invalid @enderror"
                                value="{{ old('no_finger', @$data->detailStaff->no_finger) }}">
                            @error('no_finger')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="short_time">Short Time</label>
                            <input type="text" name="short_time"
                                class="form-control  @error('short_time') is-invalid @enderror"
                                value="{{ old('short_time', @$data->detailStaff->short_time) }}">
                            @error('short_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="alpha">I/S/A Non alphaeransi</label>
                            <input type="text" name="alpha" class="form-control  @error('alpha') is-invalid @enderror"
                                value="{{ old('alpha', @$data->detailStaff->alpha) }}">
                            @error('alpha')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="sanksi">Sanksi SP</label>
                            <input type="text" name="sanksi" class="form-control  @error('sanksi') is-invalid @enderror"
                                value="{{ old('sanksi', @$data->detailStaff->sanksi) }}">
                            @error('sanksi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="kasbon">Kasbon</label>
                            <input type="text" name="kasbon" class="form-control  @error('kasbon') is-invalid @enderror"
                                value="{{ old('kasbon', @$data->detailStaff->kasbon) }}">
                            @error('kasbon')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="makanNonDinas">Uang Makan Non Dinas</label>
                            <input type="text" name="makanNonDinas"
                                class="form-control  @error('makanNonDinas') is-invalid @enderror"
                                value="{{ old('makanNonDinas', @$data->detailStaff->makanNonDinas) }}">
                            @error('makanNonDinas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="potonganLain">Potongan Lain-Lain</label>
                            <input type="text" name="potonganLain"
                                class="form-control  @error('potonganLain') is-invalid @enderror"
                                value="{{ old('potonganLain', @$data->detailStaff->potonganLain) }}">
                            @error('potonganLain')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="dosen" style="display: none">
                <h3>Gaji Dosen</h3>
                <hr>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="mengajar">Mengajar</label>
                            <input type="text" name="mengajar"
                                class="form-control  @error('mengajar') is-invalid @enderror"
                                value="{{ old('mengajar', @$data->detailDosen->mengajar) }}">
                            @error('mengajar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="wali">Dosen Wali</label>
                            <input type="text" name="wali" class="form-control  @error('wali') is-invalid @enderror"
                                value="{{ old('wali', @$data->detailDosen->wali) }}">
                            @error('wali')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="transport">Transport</label>
                            <input type="text" name="transport"
                                class="form-control  @error('transport') is-invalid @enderror"
                                value="{{ old('transport', @$data->detailDosen->transport) }}">
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
                            <input type="text" name="regular"
                                class="form-control  @error('regular') is-invalid @enderror"
                                value="{{ old('regular', @$data->detailDosen->regular) }}">
                            @error('regular')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="karyawan">Karyawan</label>
                            <input type="text" name="karyawan"
                                class="form-control  @error('karyawan') is-invalid @enderror"
                                value="{{ old('karyawan', @$data->detailDosen->karyawan) }}">
                            @error('karyawan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="eksekutif">Eksekutif / Smt Pendek</label>
                            <input type="text" name="eksekutif"
                                class="form-control  @error('eksekutif') is-invalid @enderror"
                                value="{{ old('eksekutif', @$data->detailDosen->eksekutif) }}">
                            @error('eksekutif')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="interTeori">International Teori</label>
                            <input type="text" name="interTeori"
                                class="form-control  @error('interTeori') is-invalid @enderror"
                                value="{{ old('interTeori', @$data->detailDosen->interTeori) }}">
                            @error('interTeori')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="interPraktek">International Tutor</label>
                            <input type="text" name="interPraktek"
                                class="form-control  @error('interPraktek') is-invalid @enderror"
                                value="{{ old('interPraktek', @$data->detailDosen->interPraktek) }}">
                            @error('interPraktek')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="kerjaPraktek">Kerja Praktek</label>
                            <input type="text" name="kerjaPraktek"
                                class="form-control  @error('kerjaPraktek') is-invalid @enderror"
                                value="{{ old('kerjaPraktek', @$data->detailDosen->kerjaPraktek) }}">
                            @error('kerjaPraktek')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <h5>Skripsi II</h5>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="skripsi2Pembimbing1">Pembimbing I</label>
                            <input type="text" name="skripsi2Pembimbing1"
                                class="form-control  @error('skripsi2Pembimbing1') is-invalid @enderror"
                                value="{{ old('skripsi2Pembimbing1', @$data->detailDosen->skripsi2Pembimbing1) }}">
                            @error('skripsi2Pembimbing1')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="skripsi2Pembimbing2">Pembimbing II</label>
                            <input type="text" name="skripsi2Pembimbing2"
                                class="form-control  @error('skripsi2Pembimbing2') is-invalid @enderror"
                                value="{{ old('skripsi2Pembimbing2', @$data->detailDosen->skripsi2Pembimbing2) }}">
                            @error('skripsi2Pembimbing2')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <h5>Tugas Akhir II</h5>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="ta2Pembimbing1">Pembimbing I</label>
                            <input type="text" name="ta2Pembimbing1"
                                class="form-control  @error('ta2Pembimbing1') is-invalid @enderror"
                                value="{{ old('ta2Pembimbing1', @$data->detailDosen->ta2Pembimbing1) }}">
                            @error('ta2Pembimbing1')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="ta2Pembimbing2">Pembimbing II</label>
                            <input type="text" name="ta2Pembimbing2"
                                class="form-control  @error('ta2Pembimbing2') is-invalid @enderror"
                                value="{{ old('ta2Pembimbing2', @$data->detailDosen->ta2Pembimbing2) }}">
                            @error('ta2Pembimbing2')
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
                            <input type="text" name="seminarSkripsi"
                                class="form-control  @error('seminarSkripsi') is-invalid @enderror"
                                value="{{ old('seminarSkripsi', @$data->detailDosen->seminarSkripsi) }}">
                            @error('seminarSkripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="seminarTerbuka">Seminar Terbuka</label>
                            <input type="text" name="seminarTerbuka"
                                class="form-control  @error('seminarTerbuka') is-invalid @enderror"
                                value="{{ old('seminarTerbuka', @$data->detailDosen->seminarTerbuka) }}">
                            @error('seminarTerbuka')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="proposal">Proposal Tugas Akhir</label>
                            <input type="text" name="proposal"
                                class="form-control  @error('proposal') is-invalid @enderror"
                                value="{{ old('proposal', @$data->detailDosen->proposal) }}">
                            @error('proposal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="ngujiTA">Tugas Akhir</label>
                            <input type="text" name="ngujiTA"
                                class="form-control  @error('ngujiTA') is-invalid @enderror"
                                value="{{ old('ngujiTA', @$data->detailDosen->ngujiTA) }}">
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
                            <input type="text" name="koreksiRegular"
                                class="form-control  @error('koreksiRegular') is-invalid @enderror"
                                value="{{ old('koreksiRegular', @$data->detailDosen->koreksiRegular) }}">
                            @error('koreksiRegular')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="koreksiKaryawan">Karyawan</label>
                            <input type="text" name="koreksiKaryawan"
                                class="form-control  @error('koreksiKaryawan') is-invalid @enderror"
                                value="{{ old('koreksiKaryawan', @$data->detailDosen->koreksiKaryawan) }}">
                            @error('koreksiKaryawan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="koreksiInter">International</label>
                            <input type="text" name="koreksiInter"
                                class="form-control  @error('koreksiInter') is-invalid @enderror"
                                value="{{ old('koreksiInter', @$data->detailDosen->koreksiInter) }}">
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
                            <input type="text" name="soalRegular"
                                class="form-control  @error('soalRegular') is-invalid @enderror"
                                value="{{ old('soalRegular', @$data->detailDosen->soalRegular) }}">
                            @error('soalRegular')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="soalKaryawan">Karyawan</label>
                            <input type="text" name="soalKaryawan"
                                class="form-control  @error('soalKaryawan') is-invalid @enderror"
                                value="{{ old('soalKaryawan', @$data->detailDosen->soalKaryawan) }}">
                            @error('soalKaryawan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="soalInter">International</label>
                            <input type="text" name="soalInter"
                                class="form-control  @error('soalInter') is-invalid @enderror"
                                value="{{ old('soalInter', @$data->detailDosen->soalInter) }}">
                            @error('soalInter')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="pengawas">Pengawas</label>
                            <input type="text" name="pengawas"
                                class="form-control  @error('pengawas') is-invalid @enderror"
                                value="{{ old('pengawas', @$data->detailDosen->pengawas) }}">
                            @error('pengawas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="lemburPengawas">Lembur Pengawas</label>
                            <input type="text" name="lemburPengawas"
                                class="form-control  @error('lemburPengawas') is-invalid @enderror"
                                value="{{ old('lemburPengawas', @$data->detailDosen->lemburPengawas) }}">
                            @error('lemburPengawas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="koor">Koor Mata Kuliah</label>
                            <input type="text" name="koor" class="form-control  @error('koor') is-invalid @enderror"
                                value="{{ old('koor', @$data->detailDosen->koor) }}">
                            @error('koor')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Edit</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(() => {
        $(".jabatan").select2({
            theme: "bootstrap"
        })
        $(".jabatanStaff").select2({
            theme: "bootstrap"
        })
        $('.staff .form-control').simpleMoneyFormat();
        $('.dosen .form-control').simpleMoneyFormat();
        handleJabatan()
        $(".jabatan").change(handleJabatan)
    })

    function handleJabatan()
    {
        var cek = $(".jabatan").val()
        if (cek.includes("dosen")) $(".dosen").fadeIn(300)
        else $(".dosen").fadeOut(300)
        if (cek.includes("staff")) $(".staff").fadeIn(300)
        else $(".staff").fadeOut(300)
    }
</script>
@endsection