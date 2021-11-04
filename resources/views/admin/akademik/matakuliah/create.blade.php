@extends('admin.template.dashboard')

@section('title', 'Tambah Matakuliah')

@section('main-content')
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data" id="form-matkul">
            @csrf
            <div class="form-group">
                <label for="kode">Kode</label>
                <input type="text" required name="kode" class="form-control  @error('kode') is-invalid @enderror"
                    value="{{ old('kode') }}">
                @error('kode')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="kode_kelas">Kode Kelas</label>
                <input type="text" required name="kode_kelas"
                    class="form-control  @error('kode_kelas') is-invalid @enderror" value="{{ old('kode_kelas') }}">
                @error('kode_kelas')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" required name="nama" class="form-control  @error('nama') is-invalid @enderror"
                    value="{{ old('nama') }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="jam">Jam</label>
                <input type="text" required name="jam" class="form-control jam  @error('jam') is-invalid @enderror"
                    value="{{ old('jam') }}">
                @error('jam')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="hari">Hari</label>
                <select name="hari" class="form-control  @error('hari') is-invalid @enderror" required>
                    @foreach ($hari as $dt)
                    <option value="{{ $dt }}" {{(old('hari')==$dt) ? 'selected' : '' }}>{{ $dt }}</option>
                    @endforeach
                </select>
                {{-- <input type="text" required name="hari" class="form-control  @error('hari') is-invalid @enderror"
                    value="{{ old('hari') }}"> --}}
                @error('hari')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="sks">SKS</label>
                <input type="number" required name="sks" class="form-control  @error('sks') is-invalid @enderror"
                    value="{{ old('sks') }}">
                @error('sks')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="jumlah_mahasiswa">Jumlah Mahasiswa</label>
                <input type="number" required name="jumlah_mahasiswa"
                    class="form-control  @error('jumlah_mahasiswa') is-invalid @enderror"
                    value="{{ old('jumlah_mahasiswa') }}">
                @error('jumlah_mahasiswa')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Kategori</label>
                <select name="kategori" id="kategori" required class="custom-select form-control">
                    <option></option>
                    <option value="Regular">Regular</option>
                    <option value="Karyawan">Karyawan</option>
                    <option value="Eksekutif / Semester Pendek">Eksekutif / Semester Pendek</option>
                    <option value="International Teori">International Teori</option>
                    <option value="International Tutor">International Tutor</option>
                </select>
            </div>

            <div class="listDosen">
                <div class="dosen">
                    <div class="form-group mb-3">
                        <label for="text">Dosen</label>
                        <select name="dosen" required class="custom-select dosenselect form-control">
                        </select>
                    </div>
                </div>
            </div>

            {{-- <button type="button" class="btn btn-primary addButton mb-4">Tambah Dosen</button> --}}
            <button type="submit" class="btn btn-block btn-primary">Tambah</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    const initDosen = () => {
        var url = `{{ route('admin.dosen.list') }}`;
        $(".dosenselect").select2({
            theme: "bootstrap",
            minimumInputLength: 2,
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
        });
    }
    initDosen()
    const addDosen = () => {
        let komponenDosen = `<div class="dosen">
                                <div class="form-group mb-3">
                                    <label for="text">Dosen</label>
                                    <select name="dosen[]" required class="custom-select dosenselect form-control">
                                    </select>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm mb-3 btn-hapus">Hapus</button><br>
                            </div>`
        $(".listDosen").append(komponenDosen);
        initDosen()
    }

    $('#kategori').select2({
        theme: "bootstrap",
        placeholder: 'Select kategori'
    })
    
    // $(".addButton").click(addDosen)

    $("body").on("click", ".btn-hapus", function(){
         $(this).parent().remove();
    });

    $("#form-matkul").submit(function(e){
        var values = $("select[name='dosen[]']").map(function(){return $(this).val();}).get();
        var cek = new Set(values);
        if(values.length !== cek.size) {
            e.preventDefault();
            toastr.error("Dosen tidak boleh sama", 'Dosen!')
            return false
        }
    })

    $(".jam").daterangepicker({
        timePicker: true,
        timePicker24Hour: true,
        // timePickerIncrement: 1,
        // timePickerSeconds: true,
        locale: {
            format: 'HH:mm'
        }
    }).on('show.daterangepicker', function (ev, picker) {
        picker.container.find(".calendar-table").hide();
    });

</script>
@endsection