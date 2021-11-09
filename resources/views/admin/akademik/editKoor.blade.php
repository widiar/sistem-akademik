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
        <form action="" method="post" enctype="multipart/form-data">
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
            <div class="koordinator">
                <hr>
                <h4>Koordinator</h4>
                <div class="row">
                    <div class="form-group col-md-6 col-xs-12">
                        <label for="koor">Jumlah</label>
                        <input required type="number" min="0" max="3" name="koor"
                            class="form-control  @error('koor') is-invalid @enderror"
                            value="{{ old('koor', @$pegawai->koordinator[0]->jumlah) }}">
                        @error('koor')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="matkul">Matakuliah</label>
                            <select name="matkul[]" id="matkul" multiple="multiple"
                                class="form-control custom-select @error('matkul') is-invalid @enderror">
                                @if($pegawai->koordinator->count() > 0)
                                @foreach (json_decode($pegawai->koordinator[0]->matakuliah) as $nama)
                                <option selected value="{{ $nama }}">{{ $nama }}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('matkul')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="bulanTahun" value="">
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

        let url = `{{ route('admin.matakuliah.list') }}`
        $('.custom-select').select2({
            theme: 'bootstrap',
            width: '100%',
            minimumInputLength: 2,
            maximumSelectionLength: 3,
            ajax: {
                url: url,
                dataType: 'json',
                delay: 800,
                data: function (params) {
                    var query = {
                        search: params.term,
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        })

    });

</script>
@endsection