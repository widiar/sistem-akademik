@extends('admin.template.dashboard')

@section('title', 'News')

@section('main-content')
<a href="{{ route('admin.news.create') }}">
    <button class="btn btn-primary btn-sm mb-3 ml-3">Tambah Berita</button>
</a>
@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> BERHASIL!</h5>
    {{session('success')}}
</div>
@elseif(session('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> GAGAL!</h5>
    {{session('error')}}
</div>
@endif
<div class="card shadow mx-3">
    <div class="card-body table-responsive">
        <table id="adminTable" class="table table-bordered dt-responsive nowrap" style="width: 100%;">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Poster</th>
                    <th>Tanggal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="actionz">
                @php
                $no=0;
                @endphp
                @if (!is_null($news))
                @foreach ($news as $ban)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $ban->title }}</td>
                    <td class="description">{!! Str::substr($ban->content, 0, 25) !!}...</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalImage"
                            data-image="{{ $ban->poster }}">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                    <td class="text-center">
                        {{ date('d/m/y h:i A', strtotime($ban->updated_at)) }}
                    </td>
                    <td class="text-center">
                        <div class="row" style="min-width: 100px">
                            <a href="{{ route('admin.news.edit', $ban->id) }}" class="mx-3">
                                <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                            </a>
                            <form action="{{ route('admin.news.destroy', $ban->id) }}" method="POST" class="deleted">
                                @method("DELETE")
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="ml-3">

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalImage" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Image Bannner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" alt="Banner Image" class="imgBanner w-100">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    var urlImage = "{{ asset('storage/news/') }}";
    $('#modalImage').on('show.bs.modal', function (event){
        var button = $(event.relatedTarget);
        var image = button.data('image');
        var modal = $(this);
        if (image == ''){
            image = "{{ asset('assets/img/poster-default.jpg') }}";
            modal.find('.imgBanner').attr('src', image);
        } 
        else
            modal.find('.imgBanner').attr('src', urlImage + '/' + image);
    });
</script>

@endsection