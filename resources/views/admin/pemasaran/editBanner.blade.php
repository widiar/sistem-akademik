@extends('admin.template.dashboard')

@section('title', 'Edit Banner')

@section('main-content')
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="{{ route('admin.banner.update', $banner->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PATCH")
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror"
                    value="{{ old('title', $banner->title) }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea type="text" name="description"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $banner->description) }}</textarea>
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
                        <span class="d-inline-block text-truncate w-75">Klik jika ingin ganti file</span>
                    </label>
                    @error("banner")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <small class="form-text text-muted">upload format file .png, .jpg max 5mb.</small>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection