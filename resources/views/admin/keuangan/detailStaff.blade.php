@extends('admin.template.dashboard')

@section('title', 'Penggajian Staff')

@section('main-content')
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
                        <input type="number" min="0" readonly required name="gaji"
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
                        <input type="number" min="0" readonly required name="lembur"
                            class="form-control  @error('lembur') is-invalid @enderror"
                            value="{{ old('lembur', @$gaji->lembur) }}">
                        @error('lembur')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <h4>Tunjangan: </h4>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    <label for="absen">Kehadiran</label>
                    <input type="number" min="0" required name="absen"
                        class="form-control  @error('absen') is-invalid @enderror"
                        value="{{ old('absen', @$absen->count()) }}">
                    @error('absen')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="makan">Uang Makan dan Transport</label>
                    <input type="number" min="0" required readonly name="makan"
                        class="form-control  @error('makan') is-invalid @enderror"
                        value="{{ old('makan', @$gaji->makan) }}">
                    @error('makan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="number" min="0" required readonly name="jabatan"
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
                        <input type="number" min="0" required readonly name="keahlian"
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
                        <input type="number" min="0" required readonly name="pulsa"
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
                        <input type="number" min="0" required readonly name="tol"
                            class="form-control  @error('tol') is-invalid @enderror"
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
                        <input type="number" min="0" required name="kurangGaji"
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
                        <input type="number" min="0" required readonly name="reward"
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
                        <input type="number" min="0" required readonly name="thr"
                            class="form-control  @error('thr') is-invalid @enderror"
                            value="{{ old('thr', @$gaji->thr) }}">
                        @error('thr')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="insentifMarketing">Insentif Marketing</label>
                <input type="number" min="0" readonly name="insentifMarketing"
                    class="form-control  @error('insentifMarketing') is-invalid @enderror"
                    value="{{ old('insentifMarketing', @$gaji->insentifMarketing) }}">
                @error('insentifMarketing')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <h3>Jumlah Gaji Kotor : Rp <span id="gaji-kotor">0</span></h3>
            <hr>
            <h3>Potongan</h3>
            <hr>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="bpjsKesehatan">BPJS Kesehatan</label>
                        <input type="number" min="0" required name="bpjsKesehatan"
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
                        <input type="number" min="0" required name="bpjsKerja"
                            class="form-control  @error('bpjsKerja') is-invalid @enderror"
                            value="{{ old('bpjsKerja', @$gaji->bpjs_kerja) }}">
                        @error('bpjsKerja')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    <label for="izinTotal">Total Izin</label>
                    <input type="number" min="0" required name="izinTotal"
                        class="form-control  @error('izinTotal') is-invalid @enderror"
                        value="{{ old('izinTotal', @$gaju->izinTotal) }}">
                    @error('izinTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="izin">Izin/Sakit</label>
                    <input type="number" min="0" required readonly name="izin"
                        class="form-control  @error('izin') is-invalid @enderror"
                        value="{{ old('izin', @$gaji->izin) }}">
                    @error('izin')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    <label for="telatTotal">Total Telat</label>
                    <input type="number" min="0" required name="telatTotal"
                        class="form-control  @error('telatTotal') is-invalid @enderror"
                        value="{{ old('telatTotal', @$gaji->telatTotal) }}">
                    @error('telatTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="telat">Telat / Short Time / No Finger</label>
                    <input type="number" min="0" required readonly name="telat"
                        class="form-control  @error('telat') is-invalid @enderror"
                        value="{{ old('telat', @$gaji->telat) }}">
                    @error('telat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    <label for="alphaTotal">Total Telat</label>
                    <input type="number" min="0" required name="alphaTotal"
                        class="form-control  @error('alphaTotal') is-invalid @enderror"
                        value="{{ old('alphaTotal', @$gaji->alphaTotal) }}">
                    @error('alphaTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="alpha">I/S/A Non alphaeransi</label>
                    <input type="number" min="0" required readonly name="alpha"
                        class="form-control  @error('alpha') is-invalid @enderror"
                        value="{{ old('alpha', @$gaji->alpha) }}">
                    @error('alpha')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for="sanksi">Sanksi SP</label>
                        <input type="number" min="0" required name="sanksi"
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
                        <input type="number" min="0" required name="kasbon"
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
                        <input type="number" min="0" required name="makanNonDinas"
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
                        <input type="number" min="0" required name="potonganLain"
                            class="form-control  @error('potonganLain') is-invalid @enderror"
                            value="{{ old('potonganLain', @$gaji->potonganLain) }}">
                        @error('potonganLain')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <h3>Jumlah Potongan : Rp <span id="potongan">0</span></h3>
            <hr>
            <h3>Jumlah Gaji Bersih : Rp <span id="gaji-bersih">0</span></h3>
            <input type="hidden" name="gajiBersih">
            <input type="hidden" name="gajiKotor">
            <input type="hidden" name="potongan">
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
        $("input[type='number']").keyup(initTotal)
        let gajiKotor = 0
        let potongan = 0
        let gajiBersih = 0
        initTotal()
        function initTotal()
        {
            let gaji = parseInt($("input[name='gaji']").val())
            let lembur = parseInt($("input[name='lembur']").val())
            let absen = parseInt($("input[name='absen']").val())
            let makan = parseInt($("input[name='makan']").val())
            let uangMakan = absen * makan
            let jabatan = parseInt($("input[name='jabatan']").val())
            let keahlian = parseInt($("input[name='keahlian']").val())
            let pulsa = parseInt($("input[name='pulsa']").val())
            let tol = parseInt($("input[name='tol']").val())
            let kurangGaji = parseInt($("input[name='kurangGaji']").val())
            let reward = parseInt($("input[name='reward']").val())
            let thr = parseInt($("input[name='thr']").val())
            let insentifMarketing = parseInt($("input[name='insentifMarketing']").val()) || 0
            gajiKotor  = gaji + lembur + uangMakan + jabatan + keahlian + pulsa + tol + kurangGaji + reward + thr + insentifMarketing
            $("#gaji-kotor").text(gajiKotor)
            $("#gaji-kotor").simpleMoneyFormat()
            
            let bpjsKesehatan = parseInt($("input[name='bpjsKesehatan']").val())
            let bpjsKerja = parseInt($("input[name='bpjsKerja']").val())
            let izin = parseInt($("input[name='izin']").val()) * (parseInt($("input[name='izinTotal']").val()) || 0)
            let telat = parseInt($("input[name='telat']").val()) * (parseInt($("input[name='telatTotal']").val()) || 0)
            let alpha = parseInt($("input[name='alpha']").val()) * (parseInt($("input[name='alphaTotal']").val()) || 0)
            let sanksi = parseInt($("input[name='sanksi']").val())
            let kasbon = parseInt($("input[name='kasbon']").val())
            let makanNonDinas = parseInt($("input[name='makanNonDinas']").val())
            let potonganLain = parseInt($("input[name='potonganLain']").val())
            potongan = bpjsKerja + bpjsKesehatan + izin + telat + alpha + sanksi + kasbon + makanNonDinas + potonganLain
            $("#potongan").text(potongan)
            $("#potongan").simpleMoneyFormat()

            gajiBersih = gajiKotor - potongan
            $("#gaji-bersih").text(gajiBersih)
            $("#gaji-bersih").simpleMoneyFormat()
        }

        $(".form-gaji").submit(function(e){
            $("input[name='gajiBersih']").val(gajiBersih)
            $("input[name='gajiKotor']").val(gajiKotor)
            $("input[name='potongan']").val(potongan)
            return true;
        })
    })
</script>
@endsection