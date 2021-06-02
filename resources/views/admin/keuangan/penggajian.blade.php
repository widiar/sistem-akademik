@extends('admin.template.dashboard')

@section('title', 'Penggajian')

@section('main-content')
@if(session('success'))
<div class="alert alert-success alert-dismissible mx-3">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> BERHASIL!</h5>
    {{session('success')}}
</div>
@elseif(session('error'))
<div class="alert alert-danger alert-dismissible mx-3">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> GAGAL!</h5>
    {{session('error')}}
</div>
@endif
<a href="{{ route('admin.laporan-gaji') }}">
    <button class="btn btn-primary btn-sm mb-3 ml-3">Buat Laporan Gaji</button>
</a>
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="" method="POST" class="form-gaji">
            @csrf
            <h4>Gaji Dosen</h4>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="pokokDosen">Gaji Pokok</label>
                        <input type="text" name="pokokDosen"
                            class="form-control  @error('pokokDosen') is-invalid @enderror"
                            value="{{ old('pokokDosen', ($dosen) ? $dosen->pokok : '') }}">
                        @error('pokokDosen')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="tunjanganDosen">Tunjangan</label>
                        <input type="text" name="tunjanganDosen"
                            class="form-control  @error('tunjanganDosen') is-invalid @enderror"
                            value="{{ old('tunjanganDosen', ($dosen) ? $dosen->tunjangan : '') }}">
                        @error('tunjanganDosen')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="bonusDosen">Bonus</label>
                        <input type="text" name="bonusDosen"
                            class="form-control  @error('bonusDosen') is-invalid @enderror"
                            value="{{ old('bonusDosen', ($dosen) ? $dosen->bonus : '') }}">
                        @error('bonusDosen')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <hr>
            <h4>Gaji Marketing</h4>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="pokokMarketing">Gaji Pokok</label>
                        <input type="text" name="pokokMarketing"
                            class="form-control  @error('pokokMarketing') is-invalid @enderror"
                            value="{{ old('pokokMarketing', ($marketing) ? $marketing->pokok : '') }}">
                        @error('pokokMarketing')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="tunjanganMarketing">Tunjangan</label>
                        <input type="text" name="tunjanganMarketing"
                            class="form-control  @error('tunjanganMarketing') is-invalid @enderror"
                            value="{{ old('tunjanganMarketing', ($marketing) ? $marketing->tunjangan : '') }}">
                        @error('tunjanganMarketing')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="bonusMarketing">Bonus</label>
                        <input type="text" name="bonusMarketing"
                            class="form-control  @error('bonusMarketing') is-invalid @enderror"
                            value="{{ old('bonusMarketing', ($marketing) ? $marketing->bonus : '') }}">
                        @error('bonusMarketing')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <hr>
            <h4>Gaji Staff</h4>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="pokokStaff">Gaji Pokok</label>
                        <input type="text" name="pokokStaff"
                            class="form-control  @error('pokokStaff') is-invalid @enderror"
                            value="{{ old('pokokStaff', ($staff) ? $staff->pokok : '') }}">
                        @error('pokokStaff')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="tunjanganStaff">Tunjangan</label>
                        <input type="text" name="tunjanganStaff"
                            class="form-control  @error('tunjanganStaff') is-invalid @enderror"
                            value="{{ old('tunjanganStaff', ($staff) ? $staff->pokok : '') }}">
                        @error('tunjanganStaff')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="bonusStaff">Bonus</label>
                        <input type="text" name="bonusStaff"
                            class="form-control  @error('bonusStaff') is-invalid @enderror"
                            value="{{ old('bonusStaff', ($staff) ? $staff->pokok : '') }}">
                        @error('bonusStaff')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="float-right">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAdmin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Laporan Keuangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" class="rekap">
                @csrf
                <div class="modal-body form-group">
                    <label for="bulan">Bulan</label>
                    <select name="bulan" class="bulan w-100" style="width: 100%;">
                        @foreach ($bulan as $k)
                        <option value="{{ $k->id }}" {{ (date('n') == $k->id) ? 'selected' : '' }}>
                            {{ $k->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Buat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('.form-control').simpleMoneyFormat();
    $('.bulan').select2({
        theme: "bootstrap"
    });
</script>
@endsection