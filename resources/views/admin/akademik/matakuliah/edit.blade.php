@extends('admin.template.dashboard')

@section('title', 'Edit Matakuliah')

@section('main-content')
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data" id="form-matkul">
            @csrf
            <div class="form-group">
                <label for="kode">Kode</label>
                <input type="text" required name="kode" class="form-control  @error('kode') is-invalid @enderror"
                    value="{{ old('kode', $matakuliah->kode) }}">
                @error('kode')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" required name="nama" class="form-control  @error('nama') is-invalid @enderror"
                    value="{{ old('nama', $matakuliah->nama) }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="jam">Jam</label>
                <input type="text" required name="jam" class="form-control  @error('jam') is-invalid @enderror"
                    value="{{ old('jam', $matakuliah->jam) }}">
                @error('jam')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="hari">Hari</label>
                <input type="text" required name="hari" class="form-control  @error('hari') is-invalid @enderror"
                    value="{{ old('hari', $matakuliah->hari) }}">
                @error('hari')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="sks">SKS</label>
                <input type="number" required name="sks" class="form-control  @error('sks') is-invalid @enderror"
                    value="{{ old('sks', $matakuliah->sks) }}">
                @error('sks')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="listDosen">
                @foreach ($matakuliah->dosen as $dsn)
                <div class="dosen">
                    <div class="form-group mb-3">
                        <label for="text">Dosen</label>
                        <select name="dosen[{{$dsn->id}}]" required
                            class="custom-select dosenselected form-control dosen-select">
                            @foreach ($dosen as $d)
                            <option {{($dsn->id == $d->id) ? 'selected' : ''}} value="{{ $d->id }}">{{ $d->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @if (!$loop->first)
                    <button type="button" class="btn btn-danger btn-sm mb-3 btn-hapus">Hapus</button><br>
                    @endif
                </div>
                @endforeach
            </div>

            {{-- <button type="button" class="btn btn-primary addButton mb-4">Tambah Dosen</button> --}}
            <button type="submit" class="btn btn-block btn-primary">Edit</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(".dosenselected").select2({
        theme: "bootstrap",
        minimumInputLength: 2,
    })
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
    // initDosen()
    const addDosen = () => {
        let komponenDosen = `<div class="dosen">
                                <div class="form-group mb-3">
                                    <label for="text">Dosen</label>
                                    <select name="dosen[]" required class="custom-select dosenselect form-control dosen-select">
                                    </select>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm mb-3 btn-hapus">Hapus</button><br>
                            </div>`
        $(".listDosen").append(komponenDosen);
        initDosen()
    }
    
    $(".addButton").click(addDosen)

    $("body").on("click", ".btn-hapus", function(){
         $(this).parent().remove();
    });

    $("#form-matkul").submit(function(e){
        var values = $(".dosen-select").map(function(){return $(this).val();}).get();
        var cek = new Set(values);
        // console.log(values)
        // console.log(cek)
        if(values.length !== cek.size) {
            e.preventDefault();
            toastr.error("Dosen tidak boleh sama", 'Dosen!')
            return false
        }
    })

</script>
@endsection