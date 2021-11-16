@extends('admin.template.dashboard')

@section('title', 'Update Dosen')

@section('main-content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="{{ route('admin.dosen.update', $pegawai->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PATCH")
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" name="nip" readonly class="form-control  @error('nip') is-invalid @enderror"
                    value="{{ old('nip', $pegawai->nip) }}">
                @error('nip')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" readonly class="form-control  @error('nama') is-invalid @enderror"
                    value="{{ old('nama', $pegawai->nama) }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama">Email</label>
                <input type="email" name="email" readonly class="form-control  @error('email') is-invalid @enderror"
                    value="{{ old('email', $pegawai->email) }}">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="pembimbingTA">
                <hr>
                <h4>Pembimbing TA</h4>
                <h5>Jumlah TA 2</h5>
                <div class="row">
                    <div class="form-group col-md-6 col-xs-12">
                        <label for="ta2pembimbing1">Pembimbing 1</label>
                        <input required type="number" min="0" name="ta2pembimbing1"
                            class="form-control  @error('ta2pembimbing1') is-invalid @enderror"
                            value="{{ old('ta2pembimbing1', @$pegawai->dosen[0]->tugas_akhir_2_pembimbing_1) }}">
                        @error('ta2pembimbing1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="nama-ta2-pembimbing1 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="ta2pembimbing1nama">Nama TA 2 (Pembimbing 1)</label>
                            <select name="ta2pembimbing1nama[]" id="ta2pembimbing1nama" multiple="multiple"
                                class="form-control custom-select">
                                @if($pegawai->dosen->count() > 0)
                                @foreach (json_decode($pegawai->dosen[0]->tugas_akhir_2_pembimbing_1_nama) as $nama)
                                <option selected value="{{ $nama }}">{{ $nama }}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('ta2pembimbing1nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-xs-12">
                        <label for="ta2pembimbing2">Pembimbing 2</label>
                        <input required type="number" min="0" name="ta2pembimbing2"
                            class="form-control  @error('ta2pembimbing2') is-invalid @enderror"
                            value="{{ old('ta2pembimbing2', @$pegawai->dosen[0]->tugas_akhir_2_pembimbing_2) }}">
                        @error('ta2pembimbing2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="nama-ta2-pembimbing1 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="ta2pembimbing2nama">Nama TA 2 (Pembimbing 2)</label>
                            <select name="ta2pembimbing2nama[]" id="ta2pembimbing2nama" multiple="multiple"
                                class="form-control custom-select">
                                @if($pegawai->dosen->count() > 0)
                                @foreach (json_decode($pegawai->dosen[0]->tugas_akhir_2_pembimbing_2_nama) as $nama)
                                <option selected value="{{ $nama }}">{{ $nama }}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('ta2pembimbing2nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="pembimbingSkripsi">
                <hr>
                <h4>Pembimbing Skripsi</h4>
                <h5>Jumlah Skripsi 2</h5>
                <div class="row">
                    <div class="form-group col-md-6 col-xs-12">
                        <label for="skripsi2pembimbing1">Pembimbing 1</label>
                        <input required type="number" min="0" name="skripsi2pembimbing1"
                            class="form-control  @error('skripsi2pembimbing1') is-invalid @enderror"
                            value="{{ old('skripsi2pembimbing1', @$pegawai->dosen[0]->skripsi_2_pembimbing_1) }}">
                        @error('skripsi2pembimbing1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="nama-ta2-pembimbing1 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="skripsi2pembimbing1nama">Nama Skripsi 2 (Pembimbing 1)</label>
                            <select name="skripsi2pembimbing1nama[]" id="skripsi2pembimbing1nama" multiple="multiple"
                                class="form-control custom-select">
                                @if($pegawai->dosen->count() > 0)
                                @foreach (json_decode($pegawai->dosen[0]->skripsi_2_pembimbing_1_nama) as $nama)
                                <option selected value="{{ $nama }}">{{ $nama }}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('skripsi2pembimbing1nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-xs-12">
                        <label for="skripsi2pembimbing2">Pembimbing 2</label>
                        <input required type="number" min="0" name="skripsi2pembimbing2"
                            class="form-control  @error('skripsi2pembimbing2') is-invalid @enderror"
                            value="{{ old('skripsi2pembimbing2', @$pegawai->dosen[0]->skripsi_2_pembimbing_2) }}">
                        @error('skripsi2pembimbing2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="nama-ta2-pembimbing1 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="skripsi2pembimbing2nama">Nama Skripsi 2 (Pembimbing 2)</label>
                            <select name="skripsi2pembimbing2nama[]" id="skripsi2pembimbing2nama" multiple="multiple"
                                class="form-control custom-select">
                                @if($pegawai->dosen->count() > 0)
                                @foreach (json_decode($pegawai->dosen[0]->skripsi_2_pembimbing_2_nama) as $nama)
                                <option selected value="{{ $nama }}">{{ $nama }}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('skripsi2pembimbing2nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="penguji">
                <hr>
                <h4>Dosen Penguji</h4>
                <div class="row">
                    <div class="form-group col-md-6 col-xs-12">
                        <label for="seminarSkripsi">Seminar Skripsi</label>
                        <input required type="number" min="0" name="seminarSkripsi"
                            class="form-control  @error('seminarSkripsi') is-invalid @enderror"
                            value="{{ old('seminarSkripsi', @$pegawai->dosen[0]->penguji_seminar_skripsi) }}">
                        @error('seminarSkripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="seminarSkripsiNama">Seminar Skripsi (Nama Mhs)</label>
                            <select name="seminarSkripsiNama[]" id="seminarSkripsiNama" multiple="multiple"
                                class="form-control custom-select">
                                @if($pegawai->dosen->count() > 0)
                                @if($pegawai->dosen[0]->penguji_seminar_skripsi_nama)
                                @foreach (json_decode($pegawai->dosen[0]->penguji_seminar_skripsi_nama) as $nama)
                                <option selected value="{{ $nama }}">{{ $nama }}</option>
                                @endforeach
                                @endif
                                @endif
                            </select>
                            @error('seminarSkripsiNama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label for="seminarTerbuka">Seminar Terbuka</label>
                        <input required type="number" min="0" name="seminarTerbuka"
                            class="form-control  @error('seminarTerbuka') is-invalid @enderror"
                            value="{{ old('seminarTerbuka', @$pegawai->dosen[0]->penguji_seminar_terbuka) }}">
                        @error('seminarTerbuka')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="nama-ta2-pembimbing1 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="seminarTerbukaNama">Seminar Terbuka (Nama Mhs)</label>
                            <select name="seminarTerbukaNama[]" id="seminarTerbukaNama" multiple="multiple"
                                class="form-control custom-select">
                                @if($pegawai->dosen->count() > 0)
                                @if($pegawai->dosen[0]->penguji_seminar_terbuka_nama)
                                @foreach (json_decode($pegawai->dosen[0]->penguji_seminar_terbuka_nama) as $nama)
                                <option selected value="{{ $nama }}">{{ $nama }}</option>
                                @endforeach
                                @endif
                                @endif
                            </select>
                            @error('seminarTerbukaNama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label for="proposal">Proposal Tugas Akhir</label>
                        <input required type="number" min="0" name="proposal"
                            class="form-control  @error('proposal') is-invalid @enderror"
                            value="{{ old('proposal', @$pegawai->dosen[0]->penguji_proposal_TA) }}">
                        @error('proposal')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="nama-ta2-pembimbing1 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="proposalNama">Proposal Tugas Akhir (Nama Mhs)</label>
                            <select name="proposalNama[]" id="proposalNama" multiple="multiple"
                                class="form-control custom-select">
                                @if($pegawai->dosen->count() > 0)
                                @if($pegawai->dosen[0]->penguji_proposal_TA_nama)
                                @foreach (json_decode($pegawai->dosen[0]->penguji_proposal_TA_nama) as $nama)
                                <option selected value="{{ $nama }}">{{ $nama }}</option>
                                @endforeach
                                @endif
                                @endif
                            </select>
                            @error('proposalNama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label for="pengujiTugasAkhir">Tugas Akhir</label>
                        <input required type="number" min="0" name="pengujiTugasAkhir"
                            class="form-control  @error('pengujiTugasAkhir') is-invalid @enderror"
                            value="{{ old('pengujiTugasAkhir', @$pegawai->dosen[0]->penguji_tugas_akhir) }}">
                        @error('pengujiTugasAkhir')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="nama-ta2-pembimbing1 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="pengujiTugasAkhirNama">Tugas Akhir (Nama Mhs)</label>
                            <select name="pengujiTugasAkhirNama[]" id="pengujiTugasAkhirNama" multiple="multiple"
                                class="form-control custom-select">
                                @if($pegawai->dosen->count() > 0)
                                @if($pegawai->dosen[0]->penguji_tugas_akhir_nama)
                                @foreach (json_decode($pegawai->dosen[0]->penguji_tugas_akhir_nama) as $nama)
                                <option selected value="{{ $nama }}">{{ $nama }}</option>
                                @endforeach
                                @endif
                                @endif
                            </select>
                            @error('pengujiTugasAkhirNama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="wali">
                <hr>
                <h4>Dosen Wali</h4>
                <div class="form-group">
                    <label for="wali">Jumlah</label>
                    <input required type="number" name="wali" class="form-control  @error('wali') is-invalid @enderror"
                        value="{{ old('wali', @$pegawai->dosen[0]->wali) }}">
                    @error('wali')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <hr>
            <h4>Kerja Praktek</h4>
            <div class="row kerja-praktek">
                <div class="form-group col-md-6 col-xs-12">
                    <label for="kerjaPraktek">Jumlah</label>
                    <input required type="text" name="kerjaPraktek"
                        class="form-control  @error('kerjaPraktek') is-invalid @enderror"
                        value="{{ old('kerjaPraktek', @$pegawai->dosen[0]->kerja_praktek) }}">
                    @error('kerjaPraktek')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="kerja-praktek-nama col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="kerjaPraktekNama">Kerja Praktek Nama (Mhs)</label>
                        <select name="kerjaPraktekNama[]" id="kerjaPraktekNama" multiple="multiple"
                            class="form-control custom-select">
                            @if($pegawai->dosen->count() > 0)
                            @foreach (json_decode($pegawai->dosen[0]->kerja_praktek_nama) as $nama)
                            <option selected value="{{ $nama }}">{{ $nama }}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('kerjaPraktekNama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <input type="hidden" name="bulanTahun" value="{{ $bulanTahun }}">
            <button required type="submit" class="btn btn-block btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.kategori').select2({
            theme: "bootstrap"
        });

        $('.custom-select').select2({
            tags: true,
            theme: 'bootstrap',
            width: '100%'
        })

        // handleSelect2()
        // $(".kategori").change(function(){
        //     handleSelect2()
        // })
    });

    // function handleSelect2()
    // {
    //     var cek = $(".kategori").val()
    //     //pengajar
    //     if(cek.includes("1")){
    //         $(".pembimbingTA").fadeIn(300);
    //     }else $(".pembimbingTA").fadeOut(300);
    //     if(cek.includes("2")){
    //         $(".pembimbingSkripsi").fadeIn(300);
    //     }else $(".pembimbingSkripsi").fadeOut(300);
    //     if(cek.includes("6")){
    //         $(".penguji").fadeIn(300);
    //     }else $(".penguji").fadeOut(300);
    //     if(cek.includes("4")){
    //         $(".koordinator").fadeIn(300);
    //     }else $(".koordinator").fadeOut(300);
    //     if(cek.includes("5")){
    //         $(".wali").fadeIn(300);
    //     }else $(".wali").fadeOut(300);
    // }
</script>
@endsection