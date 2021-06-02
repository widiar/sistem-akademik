@extends('template.home')

@section('title', 'Home')

@section('section-main')
@include('template.carousel')

<main id="main">

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-title">
                <h2>News</h2>
                <p>Berita Terbaru</p>
            </div>
            <div class="row">
                @foreach ($news as $item)
                <div class="col-lg-12">
                    <div class="icon-box">
                        @php
                        if($item->poster) $src = Storage::url('news/' . $item->poster);
                        else $src = '/assets/img/poster-default.jpg';
                        @endphp
                        <img src="{{ $src }}" alt="" class="img-box img-thumbnail">
                        <h4><a href="{{ route('news', $item->slug) }}">{{ $item->title }}</a></h4>
                        <small class="text-muted">{{ date('d/m/y h:i A', strtotime($item->updated_at)) }}</small>
                        <p>{{ strip_tags($item->content) }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="float-right mt-4">
                <a href="{{ route('news.all') }}">
                    <button class="btn btn-outline-primary btn-sm">View All</button>
                </a>
            </div>

        </div>
    </section><!-- End Services Section -->

</main><!-- End #main -->
@endsection