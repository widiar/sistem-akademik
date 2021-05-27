@extends('template.home')

@section('title', 'News')

@section('section-main')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>News</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>News</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container">

            <div class="row">

                @foreach ($news as $new)
                <div class="col-lg-4  col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                    <article class="entry">

                        <div class="entry-img">
                            @if($new->poster)
                            <img src="{{ Storage::url('news/' . $new->poster) }}" alt="" class="img-fluid img-poster"
                                style="height: 200px">
                            @else
                            <img src="{{ asset('assets/img/poster-default.jpg') }}" alt="" class="img-fluid img-poster"
                                style="height: 200px">
                            @endif
                        </div>

                        <h2 class="entry-title">
                            <a href="{{ route('news', $new->slug) }}">{{ $new->title }}</a>
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i>
                                    {{ date('d/m/y h:i A', strtotime($new->updated_at)) }}</li>
                            </ul>
                        </div>

                        <div class="entry-content">
                            <p class="pNewsList">
                                {{ strip_tags($new->content) }}
                            </p>
                            <div class="read-more">
                                <a href="{{ route('news', $new->slug) }}">Read More</a>
                            </div>
                        </div>

                    </article><!-- End blog entry -->
                </div>

                @endforeach

            </div>

            <div class="blog-pagination" data-aos="fade-up">
                {{ $news->links() }}
                {{-- <ul class="justify-content-center">
                    <li><a href=""><i class="icofont-rounded-left"></i></a></li>
                    <li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#"><i class="icofont-rounded-right"></i></a></li>
                </ul> --}}
            </div>

        </div>
    </section><!-- End Blog Section -->

</main><!-- End #main -->
@endsection