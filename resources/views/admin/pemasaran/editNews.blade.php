@extends('admin.template.dashboard')

@section('title', 'Edit News')

@section('main-content')
<div class="card shadow mx-3">
    <div class="card-body">
        <form action="{{ route('admin.news.update', $news->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PATCH")
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror"
                    value="{{ old('title', $news->title) }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="poster">Poster</label>
                <div class="custom-file">
                    <input type="file" name="poster"
                        class="file custom-file-input @error('poster') is-invalid @enderror" id="poster"
                        value="{{ old('poster') }}" accept="image/x-png, image/jpeg">
                    <label class="custom-file-label" for="poster">
                        <span class="d-inline-block text-truncate w-75">Browse File</span>
                    </label>
                    @error("poster")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <small class="form-text text-muted">upload format file .png, .jpg max 5mb.</small>
            </div>
            <div class="form-group">
                <label for="content">Konten</label>
                <textarea type="text" name="content" id="content"
                    class="form-control @error('content') is-invalid @enderror">{{ old('content', $news->content) }}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-block btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    CKEDITOR.replace('content', options);
</script>
@endsection