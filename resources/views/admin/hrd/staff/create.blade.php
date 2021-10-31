@extends('admin.template.dashboard')

@section('title', 'Tambah Pegawai')

@section('main-content')
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="{{ route('admin.staff.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" name="nip" class="form-control  @error('nip') is-invalid @enderror"
                    value="{{ old('nip') }}">
                @error('nip')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control  @error('nama') is-invalid @enderror"
                    value="{{ old('nama') }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror"
                    value="{{ old('email') }}">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="kategori">Jabatan</label>
                <select name="jabatan[]" multiple="multiple"
                    class="jabatan w-100  @error('jabatan') is-invalid @enderror" style="width: 100%">
                    <option {{ (is_array(old('jabatan')) && in_array("dosen", old('jabatan'))) ? ' selected' : '' }}
                        value="dosen">Dosen</option>
                    <option {{ (is_array(old('jabatan')) && in_array("staff", old('jabatan'))) ? ' selected' : '' }}
                        value="staff">Staff</option>
                </select>
                @error('jabatan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="staff" style="display: none">
                <div class="form-group">
                    <label for="kategori">Jabatan Staff</label>
                    <select name="jabatanStaff[]" multiple="multiple"
                        class="jabatanStaff w-100  @error('jabatanStaff') is-invalid @enderror" style="width: 100%">
                        <option {{ (is_array(old('jabatanStaff')) && in_array("akademik", old('jabatanStaff')))
                            ? ' selected' : '' }} value="akademik">Akademik</option>
                        <option {{ (is_array(old('jabatanStaff')) && in_array("keuangan", old('jabatanStaff')))
                            ? ' selected' : '' }} value="keuangan">Keuangan</option>
                        <option {{ (is_array(old('jabatanStaff')) && in_array("pemasaran", old('jabatanStaff')))
                            ? ' selected' : '' }} value="pemasaran">Pemasaran</option>
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
                                value="{{ old('gaji', @$gaji->gaji) }}">
                            @error('gaji')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="lembur">Lembur</label>
                            <input type="text" name="lembur" class="form-control  @error('lembur') is-invalid @enderror"
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
                            <input type="text" name="makan" class="form-control  @error('makan') is-invalid @enderror"
                                value="{{ old('makan', @$gaji->makan) }}">
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
                                value="{{ old('jabatanGaji', @$gaji->jabatan) }}">
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
                                value="{{ old('keahlian', @$gaji->keahlian) }}">
                            @error('keahlian')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="pulsa">Pulsa</label>
                            <input type="text" name="pulsa" class="form-control  @error('pulsa') is-invalid @enderror"
                                value="{{ old('pulsa', @$gaji->pulsa) }}">
                            @error('pulsa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="tol">Tol / Bensin</label>
                            <input type="text" name="tol" class="form-control  @error('tol') is-invalid @enderror"
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
                            <input type="text" name="kurangGaji"
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
                            <input type="text" name="reward" class="form-control  @error('reward') is-invalid @enderror"
                                value="{{ old('reward', @$gaji->reward) }}">
                            @error('reward')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="thr">THR</label>
                            <input type="text" name="thr" class="form-control  @error('thr') is-invalid @enderror"
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
                            <input type="text" name="bpjsKesehatan"
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
                            <input type="text" name="bpjsKerja"
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
                            <input type="text" name="izin" class="form-control  @error('izin') is-invalid @enderror"
                                value="{{ old('izin', @$gaji->izin) }}">
                            @error('izin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="telat">Telat / Short Time / No Finger</label>
                            <input type="text" name="telat" class="form-control  @error('telat') is-invalid @enderror"
                                value="{{ old('telat', @$gaji->telat) }}">
                            @error('telat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="alpha">I/S/A Non alphaeransi</label>
                            <input type="text" name="alpha" class="form-control  @error('alpha') is-invalid @enderror"
                                value="{{ old('alpha', @$gaji->alpha) }}">
                            @error('alpha')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="sanksi">Sanksi SP</label>
                            <input type="text" name="sanksi" class="form-control  @error('sanksi') is-invalid @enderror"
                                value="{{ old('sanksi', @$gaji->sanksi) }}">
                            @error('sanksi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="kasbon">Kasbon</label>
                            <input type="text" name="kasbon" class="form-control  @error('kasbon') is-invalid @enderror"
                                value="{{ old('kasbon', @$gaji->kasbon) }}">
                            @error('kasbon')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="makanNonDinas">Uang Makan Non Dinas</label>
                            <input type="text" name="makanNonDinas"
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
                            <input type="text" name="potonganLain"
                                class="form-control  @error('potonganLain') is-invalid @enderror"
                                value="{{ old('potonganLain', @$gaji->potonganLain) }}">
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
                                value="{{ old('mengajar', @$gaji->mengajar) }}">
                            @error('mengajar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="wali">Dosen Wali</label>
                            <input type="text" name="wali" class="form-control  @error('wali') is-invalid @enderror"
                                value="{{ old('wali', @$gaji->wali) }}">
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
                            <input type="text" name="regular"
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
                            <input type="text" name="karyawan"
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
                            <input type="text" name="eksekutif"
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
                            <input type="text" name="interTeori"
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
                            <input type="text" name="interPraktek"
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
                            <input type="text" name="kerjaPraktek"
                                class="form-control  @error('kerjaPraktek') is-invalid @enderror"
                                value="{{ old('kerjaPraktek', @$gaji->kerjaPraktek) }}">
                            @error('kerjaPraktek')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <h5>Skripsi I</h5>
                <div class="form-group">
                    <label for="skripsi1">Skripsi I</label>
                    <input type="text" name="skripsi1" class="form-control  @error('skripsi1') is-invalid @enderror"
                        value="{{ old('skripsi1', @$gaji->skripsi1) }}">
                    @error('skripsi1')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <h5>Skripsi II</h5>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="skripsi2Pembimbing1">Pembimbing I</label>
                            <input type="text" name="skripsi2Pembimbing1"
                                class="form-control  @error('skripsi2Pembimbing1') is-invalid @enderror"
                                value="{{ old('skripsi2Pembimbing1', @$gaji->skripsi2Pembimbing1) }}">
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
                                value="{{ old('skripsi2Pembimbing2', @$gaji->skripsi2Pembimbing2) }}">
                            @error('skripsi2Pembimbing2')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <h5>Tugas Akhir I</h5>
                <div class="form-group">
                    <label for="ta1">Tugas Akhir I</label>
                    <input type="text" name="ta1" class="form-control  @error('ta1') is-invalid @enderror"
                        value="{{ old('ta1', @$gaji->ta1) }}">
                    @error('ta1')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <h5>Tugas Akhir II</h5>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="ta2Pembimbing1">Pembimbing I</label>
                            <input type="text" name="ta2Pembimbing1"
                                class="form-control  @error('ta2Pembimbing1') is-invalid @enderror"
                                value="{{ old('ta2Pembimbing1', @$gaji->ta2Pembimbing1) }}">
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
                                value="{{ old('ta2Pembimbing2', @$gaji->ta2Pembimbing2) }}">
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
                                value="{{ old('seminarSkripsi', @$gaji->seminarSkripsi) }}">
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
                                value="{{ old('seminarTerbuka', @$gaji->seminarTerbuka) }}">
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
                                value="{{ old('proposal', @$gaji->proposal) }}">
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
                            <input type="text" name="koreksiRegular"
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
                            <input type="text" name="koreksiKaryawan"
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
                            <input type="text" name="koreksiInter"
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
                            <input type="text" name="soalRegular"
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
                            <input type="text" name="soalKaryawan"
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
                            <input type="text" name="soalInter"
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
                            <label for="pengawas">Pengawas</label>
                            <input type="text" name="pengawas"
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
                            <input type="text" name="lemburPengawas"
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
                            <input type="text" name="koor" class="form-control  @error('koor') is-invalid @enderror"
                                value="{{ old('koor', @$gaji->koor) }}">
                            @error('koor')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Tambah</button>
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