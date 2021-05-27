@extends('admin.template.dashboard')

@section('title', 'Add Banner')

@section('main-content')
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="{{ route('admin.banner.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror"
                    value="{{ old('title') }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea type="text" name="description"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="banner">Foto Banner</label>
                <div class="custom-file">
                    <input type="file" name="banner"
                        class="file custom-file-input @error('banner') is-invalid @enderror" id="banner"
                        value="{{ old('banner') }}" accept="image/x-png, image/jpeg">
                    <label class="custom-file-label" for="banner">
                        <span class="d-inline-block text-truncate w-75">Browse File</span>
                    </label>
                    @error("banner")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <small id="exampleInputFile" class="form-text text-muted">upload format file .png, .jpg max 5mb.</small>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Tambah</button>
        </form>
    </div>
</div>
@endsection