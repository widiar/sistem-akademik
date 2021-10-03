@extends('admin.template.dashboard')

@section('title', 'Update Dosen')

@section('main-content')
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="{{ route('admin.dosen.update', $dosen->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PATCH")
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" name="nip" class="form-control  @error('nip') is-invalid @enderror"
                    value="{{ old('nip', $dosen->nip) }}">
                @error('nip')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control  @error('nama') is-invalid @enderror"
                    value="{{ old('nama', $dosen->nama) }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="kategori[]" multiple="multiple" class="kategori @error('kategori') is-invalid @enderror"
                    style="width: 100%">
                    @foreach ($dosen->kategori as $kat)
                    <option value="{{ $kat->id }}" selected>{{ $kat->kategori }}</option>
                    @endforeach
                    @foreach ($kategori as $i => $k)
                    <option value="{{ $k->id }}"
                        {{ (is_array(old('kategori')) && in_array($k->id, old('kategori'))) ? ' selected' : '' }}>
                        {{ $k->kategori }}
                    </option>
                    @endforeach
                </select>
                @error('kategori')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="pengajar">
                <hr>
                <h4>SKS Dosen Pengajar</h4>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="sksGanjil">Semester Ganjil</label>
                            <input type="text" name="sksGanjil"
                                class="form-control  @error('sksGanjil') is-invalid @enderror"
                                value="{{ old('sksGanjil', ($sks) ? $sks->pivot->semester_ganjil : '') }}">
                            @error('sksGanjil')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="sksGenap">Semester Genap</label>
                            <input type="text" name="sksGenap"
                                class="form-control  @error('sksGenap') is-invalid @enderror"
                                value="{{ old('sksGenap', ($sks) ? $sks->pivot->semester_genap : '') }}">
                            @error('sksGenap')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="pembimbing">
                <hr>
                <h4>Dosen Pembimbing</h4>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="pGanjil">Semester Ganjil</label>
                            <input type="text" name="pGanjil"
                                class="form-control  @error('pGanjil') is-invalid @enderror"
                                value="{{ old('pGanjil', ($pembimbing) ? $pembimbing->pivot->semester_ganjil : '') }}">
                            @error('pGanjil')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="pGenap">Semester Genap</label>
                            <input type="text" name="pGenap" class="form-control  @error('pGenap') is-invalid @enderror"
                                value="{{ old('pGenap', ($pembimbing) ? $pembimbing->pivot->semester_genap : '') }}">
                            @error('pGenap')
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
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="pjGanjil">Semester Ganjil</label>
                            <input type="text" name="pjGanjil"
                                class="form-control  @error('pjGanjil') is-invalid @enderror"
                                value="{{ old('pjGanjil', ($penguji) ? $penguji->pivot->semester_ganjil : '') }}">
                            @error('pjGanjil')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="pjGenap">Semester Genap</label>
                            <input type="text" name="pjGenap"
                                class="form-control  @error('pjGenap') is-invalid @enderror"
                                value="{{ old('pjGenap', ($penguji) ? $penguji->pivot->semester_genap : '') }}">
                            @error('pjGenap')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="koordinator">
                <hr>
                <h4>Dosen Koordinator</h4>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="kGanjil">Semester Ganjil</label>
                            <input type="text" name="kGanjil"
                                class="form-control  @error('kGanjil') is-invalid @enderror"
                                value="{{ old('kGanjil', ($koor) ? $koor->pivot->semester_ganjil : '') }}">
                            @error('kGanjil')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="kGenap">Semester Genap</label>
                            <input type="text" name="kGenap" class="form-control  @error('kGenap') is-invalid @enderror"
                                value="{{ old('kGenap', ($koor) ? $koor->pivot->semester_genap : '') }}">
                            @error('kGenap')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="wali">
                <hr>
                <h4>Dosen Wali</h4>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="wGanjil">Semester Ganjil</label>
                            <input type="text" name="wGanjil"
                                class="form-control  @error('wGanjil') is-invalid @enderror"
                                value="{{ old('wGanjil', ($wali) ? $wali->pivot->semester_ganjil : '') }}">
                            @error('wGanjil')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="wGenap">Semester Genap</label>
                            <input type="text" name="wGenap" class="form-control  @error('wGenap') is-invalid @enderror"
                                value="{{ old('wGenap', ($wali) ? $wali->pivot->semester_genap : '') }}">
                            @error('wGenap')
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

        $(".pengajar").fadeOut();
        $(".pembimbing").fadeOut();
        $(".penguji").fadeOut();
        $(".koordinator").fadeOut();
        $(".wali").fadeOut();
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
            $(".pengajar").fadeIn(300);
        }else $(".pengajar").fadeOut(300);
        if(cek.includes("2")){
            $(".pembimbing").fadeIn(300);
        }else $(".pembimbing").fadeOut(300);
        if(cek.includes("3")){
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