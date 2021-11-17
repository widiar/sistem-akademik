@extends('admin.template.dashboard')

@section('title', 'Absen Bulanan Staff')

@section('main-content')
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="" method="POST">
            @csrf
            @method("PUT")
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
                <label for="cuti">Cuti</label>
                <input min="0" type="number" required name="cuti"
                    class="form-control  @error('cuti') is-invalid @enderror"
                    value="{{ old('cuti', @$pegawai->absenStaff[0]->cuti) }}">
                @error('cuti')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="sakit">Sakit</label>
                <input min="0" type="number" required name="sakit"
                    class="form-control  @error('sakit') is-invalid @enderror"
                    value="{{ old('sakit', @$pegawai->absenStaff[0]->sakit) }}">
                @error('sakit')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="izin">Izin</label>
                <input min="0" type="number" required name="izin"
                    class="form-control  @error('izin') is-invalid @enderror"
                    value="{{ old('izin', @$pegawai->absenStaff[0]->izin) }}">
                @error('izin')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="alpha">I/S/A/Non Toleransi</label>
                <input min="0" type="number" required name="alpha"
                    class="form-control  @error('alpha') is-invalid @enderror"
                    value="{{ old('alpha', @$pegawai->absenStaff[0]->alpha) }}">
                @error('alpha')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="short">Short Time</label>
                <input min="0" type="number" required name="short"
                    class="form-control  @error('short') is-invalid @enderror"
                    value="{{ old('short', @$pegawai->absenStaff[0]->short) }}">
                @error('short')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="telat_kurang">Telat Kurang Dari 30 Menit</label>
                <input min="0" type="number" required name="telat_kurang"
                    class="form-control  @error('telat_kurang') is-invalid @enderror"
                    value="{{ old('telat_kurang', @$pegawai->absenStaff[0]->telat_kurang) }}">
                @error('telat_kurang')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="telat_lebih">Telat Lebih Dari 30 Menit</label>
                <input min="0" type="number" required name="telat_lebih"
                    class="form-control  @error('telat_lebih') is-invalid @enderror"
                    value="{{ old('telat_lebih', @$pegawai->absenStaff[0]->telat_lebih) }}">
                @error('telat_lebih')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="no_finger">Tidak Finger</label>
                <input min="0" type="number" required name="no_finger"
                    class="form-control  @error('no_finger') is-invalid @enderror"
                    value="{{ old('no_finger', @$pegawai->absenStaff[0]->no_finger) }}">
                @error('no_finger')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="total_SIA">Total Sakit Izin Alpha</label>
                <input min="0" type="number" name="total_SIA" readonly
                    class="form-control  @error('total_SIA') is-invalid @enderror"
                    value="{{ old('total_SIA', @$pegawai->absenStaff[0]->total_SIA) }}">
                @error('total_SIA')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-primary btn-block" type="submit">Save</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('input[name="sakit"]').keyup(totalSIA)
        $('input[name="izin"]').keyup(totalSIA)
        $('input[name="alpha"]').keyup(totalSIA)
    })

    function totalSIA(){
        const sakit =  $('input[name="sakit"]').val() || 0
        const izin =  $('input[name="izin"]').val() || 0
        const alpha =  $('input[name="alpha"]').val() || 0
        const total = parseInt(sakit) + parseInt(izin) + parseInt(alpha)
        $('input[name="total_SIA"]').val(total)
    }
</script>
@endsection