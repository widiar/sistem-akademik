@extends('template.home')

@section('title', 'News')

@section('section-main')
<main id="main">

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog mt-3">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 entries mx-auto">

                    <article class="entry entry-single">

                        @if($news->poster)
                        <div class="entry-img">
                            @env('local')
                            <img src="{{ Storage::url('news/' . $news->poster) }}" alt="" class="img-fluid img-poster"
                                style="height: 300px">
                            @endenv
                            @env('heroku')
                            <img src="{{ json_decode($news->poster)->url }}" alt="" class="img-fluid img-poster"
                                style="height: 300px">

                            @endenv
                        </div>
                        @endif

                        <h2 class="entry-title mt-4">
                            <a href="blog-single.html">{{ $news->title }}</a>
                        </h2>

                        <div class="entry-meta">
                            <ul>
                                <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i><time
                                        datetime="2020-01-01">{{ date('d/m/y h:i A', strtotime($news->updated_at))
                                        }}</time>
                                </li>
                            </ul>
                        </div>

                        <div class="entry-content">

                            {!! $news->content !!}

                        </div>

                    </article><!-- End blog entry -->

                </div><!-- End blog entries list -->

            </div>

        </div>
    </section><!-- End Blog Section -->

</main><!-- End #main -->
@endsection