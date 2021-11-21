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
                    @php
                    if (isset($gaji->gaji)) $pokok=$gaji->gaji;
                    else $pokok = $gaji->gaji_pokok;
                    @endphp
                    <div class="form-group">
                        <label for="gaji">Gaji Pokok</label>
                        <input type="number" min="0" readonly required name="gaji"
                            class="form-control  @error('gaji') is-invalid @enderror"
                            value="{{ old('gaji', @$pokok) }}">
                        @error('gaji')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="jam_lembur">Jam Lembur</label>
                <input type="number" min="0" required name="jam_lembur"
                    class="form-control  @error('jam_lembur') is-invalid @enderror"
                    value="{{ old('jam_lembur', @$gaji->jam_lembur) }}">
                @error('jam_lembur')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="lembur">Lembur</label>
                <input type="number" min="0" readonly required name="lembur"
                    class="form-control  @error('lembur') is-invalid @enderror"
                    value="{{ old('lembur', @$gaji->lembur) }}">
                @error('lembur')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <h4>Tunjangan: </h4>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    <label for="absen">Kehadiran</label>
                    <input type="number" min="0" required name="absen"
                        class="form-control  @error('absen') is-invalid @enderror"
                        value="{{ old('absen', @$kehadiran) }}">
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
                        <input type="number" min="0" required name="reward"
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
                        <input type="number" min="0" required name="thr"
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
                <input type="number" min="0" name="insentifMarketing"
                    class="form-control  @error('insentifMarketing') is-invalid @enderror"
                    value="{{ old('insentifMarketing', @$insentif) }}">
                @error('insentifMarketing')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <h3 style="display: none">Jumlah Gaji Kotor : Rp <span id="gaji-kotor">0</span></h3>
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
                    @php
                    if(isset($gaji->gaji_pokok)) $telatKurangTotal = $gaji->telat_kurangTotal;
                    else $telatKurangTotal = $absen->telat_kurang;
                    @endphp
                    <label for="telat_kurangTotal">Total Telat Kurang Dari 30 Menit</label>
                    <input type="number" min="0" required name="telat_kurangTotal"
                        class="form-control  @error('telat_kurangTotal') is-invalid @enderror"
                        value="{{ old('telat_kurangTotal', @$telatKurangTotal) }}">
                    @error('telat_kurangTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    @php
                    if(isset($gaji->gaji_pokok)) $telatKurang = $gaji->telat_kurang;
                    else $telatKurang = $gaji->makan * 0.5;
                    @endphp
                    <label for="telat_kurang">Telat Kurang Dari 30 Menit</label>
                    <input type="number" min="0" required readonly name="telat_kurang"
                        class="form-control  @error('telat_kurang') is-invalid @enderror"
                        value="{{ old('telat_kurang', @$telatKurang) }}">
                    @error('telat_kurang')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    @php
                    if(isset($gaji->gaji_pokok)) $telatLebihTotal = $gaji->telat_lebihTotal;
                    else $telatLebihTotal = $absen->telat_lebih;
                    @endphp
                    <label for="telat_lebihTotal">Total Telat Lebih Dari 30 Menit</label>
                    <input type="number" min="0" required name="telat_lebihTotal"
                        class="form-control  @error('telat_lebihTotal') is-invalid @enderror"
                        value="{{ old('telat_lebihTotal', @$telatLebihTotal) }}">
                    @error('telat_lebihTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    @php
                    if(isset($gaji->gaji_pokok)) $telatlebih = $gaji->telat_lebih;
                    else $telatlebih = $gaji->makan;
                    @endphp
                    <label for="telat_lebih">Telat lebih Dari 30 Menit</label>
                    <input type="number" min="0" required readonly name="telat_lebih"
                        class="form-control  @error('telat_lebih') is-invalid @enderror"
                        value="{{ old('telat_lebih', @$telatlebih) }}">
                    @error('telat_lebih')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                @php
                if(isset($gaji->gaji_pokok)) $shortTotal = $gaji->shortTotal;
                else $shortTotal = $absen->short;
                @endphp
                <div class="form-group col-xs-12 col-md-6">
                    <label for="shortTotal">Total Short Time</label>
                    <input type="number" min="0" required name="shortTotal"
                        class="form-control  @error('shortTotal') is-invalid @enderror"
                        value="{{ old('shortTotal', @$shortTotal) }}">
                    @error('shortTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    @php
                    if(isset($gaji->gaji_pokok)) $short = $gaji->short;
                    else $short = $gaji->short_time;
                    @endphp
                    <label for="short">Short Time</label>
                    <input type="number" min="0" required readonly name="short"
                        class="form-control  @error('short') is-invalid @enderror" value="{{ old('short', @$short) }}">
                    @error('short')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    @php
                    if(isset($gaji->gaji_pokok)) $noFingerTotal = $gaji->no_fingerTotal;
                    else $noFingerTotal = $absen->no_finger;
                    @endphp
                    <label for="no_fingerTotal">Total Tidak Finger</label>
                    <input type="number" min="0" required name="no_fingerTotal"
                        class="form-control  @error('no_fingerTotal') is-invalid @enderror"
                        value="{{ old('no_fingerTotal', @$noFingerTotal) }}">
                    @error('no_fingerTotal')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="no_finger">Tidak Finger</label>
                    <input type="number" min="0" required readonly name="no_finger"
                        class="form-control  @error('no_finger') is-invalid @enderror"
                        value="{{ old('no_finger', @$gaji->no_finger) }}">
                    @error('no_finger')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-12 col-md-6">
                    @php
                    if(isset($gaji->gaji_pokok)) $alphaTotal = $gaji->alphaTotal;
                    else $alphaTotal = $absen->total_SIA;
                    @endphp
                    <label for="alphaTotal">Total I/S/A Non alphaeransi</label>
                    <input type="number" min="0" required name="alphaTotal"
                        class="form-control  @error('alphaTotal') is-invalid @enderror"
                        value="{{ old('alphaTotal', @$alphaTotal) }}">
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
            <h3 style="display: none">Jumlah Potongan : Rp <span id="potongan">0</span></h3>
            <hr>
            <h3 style="display: none">Jumlah Gaji Bersih : Rp <span id="gaji-bersih">0</span></h3>
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
        $('input[name="jam_lembur"]').keyup(initLembur)

        function initLembur() {
            const jam = parseInt($('input[name="jam_lembur"]').val())
            const gaji = parseInt($("input[name='gaji']").val())
            const lembur = (jam / 173) * gaji
            $("input[name='lembur']").val(parseInt(lembur))
        }

        function initTotal()
        {
            let gaji = parseInt($("input[name='gaji']").val())
            let lembur = parseInt($("input[name='lembur']").val()) || 0
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
            let telat_kurang = parseInt($("input[name='telat_kurang']").val()) * (parseInt($("input[name='telat_kurangTotal']").val()) || 0)
            let telat_lebih = parseInt($("input[name='telat_lebih']").val()) * (parseInt($("input[name='telat_lebihTotal']").val()) || 0)
            let short = parseInt($("input[name='short']").val()) * (parseInt($("input[name='shortTotal']").val()) || 0)
            let no_finger = parseInt($("input[name='no_finger']").val()) * (parseInt($("input[name='no_fingerTotal']").val()) || 0)
            let alpha = parseInt($("input[name='alpha']").val()) * (parseInt($("input[name='alphaTotal']").val()) || 0)
            let sanksi = parseInt($("input[name='sanksi']").val())
            let kasbon = parseInt($("input[name='kasbon']").val())
            let makanNonDinas = parseInt($("input[name='makanNonDinas']").val()) || 0
            let potonganLain = parseInt($("input[name='potonganLain']").val())
            potongan = bpjsKerja + bpjsKesehatan + telat_lebih + telat_kurang + short + no_finger + alpha + sanksi + kasbon + makanNonDinas + potonganLain
            $("#potongan").text(potongan)
            $("#potongan").simpleMoneyFormat()

            gajiBersih = gajiKotor - potongan
            $("#gaji-bersih").text(gajiBersih)
            $("#gaji-bersih").simpleMoneyFormat()

            $("input[name='gajiBersih']").val(gajiBersih)
            $("input[name='gajiKotor']").val(gajiKotor)
            $("input[name='potongan']").val(potongan)
        }

        // $(".form-gaji").submit(function(e){
            
        //     return true;
        // })
    })
</script>
@endsection