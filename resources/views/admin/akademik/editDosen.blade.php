@extends('admin.template.dashboard')

@section('title', 'Update Dosen')

@section('main-content')
{{-- @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif --}}
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
            <div class="form-group">
                @php
                $kategoriDosen = [];
                if($pegawai->dosen)
                foreach($pegawai->dosen as $pg)
                array_push($kategoriDosen, $pg->id)
                @endphp
                <label for="kategori">Kategori</label>
                <select name="kategori[]" multiple="multiple" class="kategori @error('kategori') is-invalid @enderror"
                    style="width: 100%">
                    @foreach ($kategori as $k)
                    <option value="{{ $k->id }}" {{ (is_array(old('kategori', $kategoriDosen)) && in_array($k->id,
                        old('kategori', $kategoriDosen))) ? '
                        selected' : '' }}>
                        {{ $k->kategori }}
                    </option>
                    @endforeach
                </select>
                @error('kategori')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="pembimbingTA" style="display: none">
                <hr>
                <h4>Pembimbing TA</h4>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="taGanjil">Semester Ganjil</label>
                            <input type="text" name="taGanjil"
                                class="form-control  @error('taGanjil') is-invalid @enderror"
                                value="{{ old('taGanjil', @json_decode($ta->pivot->semester_ganjil)->ganjil) }}">
                            @error('taGanjil')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="taGenap">Semester Genap</label>
                            <input type="text" name="taGenap"
                                class="form-control  @error('taGenap') is-invalid @enderror"
                                value="{{ old('taGenap', @json_decode($ta->pivot->semester_genap)->genap) }}">
                            @error('taGenap')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="ta1Ganjil">Tugas Akhir I (Ganjil)</label>
                            <input type="text" name="ta1Ganjil"
                                class="form-control  @error('ta1Ganjil') is-invalid @enderror"
                                value="{{ old('ta1Ganjil', @json_decode($ta->pivot->semester_ganjil)->ta1) }}">
                            @error('ta1Ganjil')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="ta1Genap">Tugas Akhir I (Genap)</label>
                            <input type="text" name="ta1Genap"
                                class="form-control  @error('ta1Genap') is-invalid @enderror"
                                value="{{ old('ta1Genap', @json_decode($ta->pivot->semester_genap)->ta1) }}">
                            @error('ta1Genap')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="ta2Ganjil">Tugas Akhir II (Ganjil)</label>
                            <input type="text" name="ta2Ganjil"
                                class="form-control  @error('ta2Ganjil') is-invalid @enderror"
                                value="{{ old('ta2Ganjil', @json_decode($ta->pivot->semester_ganjil)->ta2) }}">
                            @error('ta2Ganjil')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="ta2Genap">Tugas Akhir II (Genap)</label>
                            <input type="text" name="ta2Genap"
                                class="form-control  @error('ta2Genap') is-invalid @enderror"
                                value="{{ old('ta2Genap', @json_decode($ta->pivot->semester_genap)->ta2) }}">
                            @error('ta2Genap')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="pembimbingSkripsi" style="display: none">
                <hr>
                <h4>Pembimbing Skripsi</h4>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="skripsiGanjil">Semester Ganjil</label>
                            <input type="text" name="skripsiGanjil"
                                class="form-control  @error('skripsiGanjil') is-invalid @enderror"
                                value="{{ old('skripsiGanjil', @json_decode($skripsi->pivot->semester_ganjil)->ganjil) }}">
                            @error('skripsiGanjil')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="skripsiGenap">Semester Genap</label>
                            <input type="text" name="skripsiGenap"
                                class="form-control  @error('skripsiGenap') is-invalid @enderror"
                                value="{{ old('skripsiGenap', @json_decode($skripsi->pivot->semester_genap)->genap) }}">
                            @error('skripsiGenap')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="skripsi1Ganjil">Tugas Akhir I (Ganjil)</label>
                            <input type="text" name="skripsi1Ganjil"
                                class="form-control  @error('skripsi1Ganjil') is-invalid @enderror"
                                value="{{ old('skripsi1Ganjil', @json_decode($skripsi->pivot->semester_ganjil)->skripsi1) }}">
                            @error('skripsi1Ganjil')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="skripsi1Genap">Tugas Akhir I (Genap)</label>
                            <input type="text" name="skripsi1Genap"
                                class="form-control  @error('skripsi1Genap') is-invalid @enderror"
                                value="{{ old('skripsi1Genap', @json_decode($skripsi->pivot->semester_genap)->skripsi1) }}">
                            @error('skripsi1Genap')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="skripsi2Ganjil">Tugas Akhir II (Ganjil)</label>
                            <input type="text" name="skripsi2Ganjil"
                                class="form-control  @error('skripsi2Ganjil') is-invalid @enderror"
                                value="{{ old('skripsi2Ganjil', @json_decode($skripsi->pivot->semester_ganjil)->skripsi2) }}">
                            @error('skripsi2Ganjil')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="skripsi2Genap">Tugas Akhir II (Genap)</label>
                            <input type="text" name="skripsi2Genap"
                                class="form-control  @error('skripsi2Genap') is-invalid @enderror"
                                value="{{ old('skripsi2Genap', @json_decode($skripsi->pivot->semester_genap)->skripsi2) }}">
                            @error('skripsi2Genap')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="penguji" style="display: none">
                <hr>
                <h4>Kerja Praktek</h4>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="kpGanjil">Semester Ganjil</label>
                            <input type="text" name="kpGanjil"
                                class="form-control  @error('kpGanjil') is-invalid @enderror"
                                value="{{ old('kpGanjil', @json_decode($kp->pivot->semester_ganjil)->ganjil) }}">
                            @error('kpGanjil')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="kpGenap">Semester Genap</label>
                            <input type="text" name="kpGenap"
                                class="form-control  @error('kpGenap') is-invalid @enderror"
                                value="{{ old('kpGenap', @json_decode($kp->pivot->semester_genap)->genap) }}">
                            @error('kpGenap')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="koordinator" style="display: none">
                <hr>
                <h4>Koordinator</h4>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="koorGanjil">Semester Ganjil</label>
                            <input type="text" name="koorGanjil"
                                class="form-control  @error('koorGanjil') is-invalid @enderror"
                                value="{{ old('koorGanjil', @json_decode($koor->pivot->semester_ganjil)->ganjil) }}">
                            @error('koorGanjil')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="koorGenap">Semester Genap</label>
                            <input type="text" name="koorGenap"
                                class="form-control  @error('koorGenap') is-invalid @enderror"
                                value="{{ old('koorGenap', @json_decode($koor->pivot->semester_genap)->genap) }}">
                            @error('koorGenap')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="wali" style="display: none">
                <hr>
                <h4>Dosen Wali</h4>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="waliGanjil">Semester Ganjil</label>
                            <input type="text" name="waliGanjil"
                                class="form-control  @error('waliGanjil') is-invalid @enderror"
                                value="{{ old('waliGanjil', @json_decode($wali->pivot->semester_ganjil)->ganjil) }}">
                            @error('waliGanjil')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="waliGenap">Semester Genap</label>
                            <input type="text" name="waliGenap"
                                class="form-control  @error('waliGenap') is-invalid @enderror"
                                value="{{ old('waliGenap', @json_decode($wali->pivot->semester_genap)->genap) }}">
                            @error('waliGenap')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Update</button>
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

        handleSelect2()
        $(".kategori").change(function(){
            handleSelect2()
        })
    });

    function handleSelect2()
    {
        var cek = $(".kategori").val()
        //pengajar
        if(cek.includes("1")){
            $(".pembimbingTA").fadeIn(300);
        }else $(".pembimbingTA").fadeOut(300);
        if(cek.includes("2")){
            $(".pembimbingSkripsi").fadeIn(300);
        }else $(".pembimbingSkripsi").fadeOut(300);
        if(cek.includes("6")){
            $(".penguji").fadeIn(300);
        }else $(".penguji").fadeOut(300);
        if(cek.includes("4")){
            $(".koordinator").fadeIn(300);
        }else $(".koordinator").fadeOut(300);
        if(cek.includes("5")){
            $(".wali").fadeIn(300);
        }else $(".wali").fadeOut(300);
    }
</script>
@endsection