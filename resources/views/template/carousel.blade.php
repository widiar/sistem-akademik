<!-- ======= Hero Section ======= -->
<section id="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

            @foreach ($banner as $ban)
            <div class="carousel-item @if ($loop->first)active @endif"
                style="background-image: {{ env('APP_ENV') == 'local' ? " url(storage/banner/$ban->image)" :
                "url(". json_decode($ban->image)->url . ")" }}">
                <div class="carousel-container">
                    <div class="container">
                        <h2 class="animate__animated animate__fadeInDown">{{ $ban->title }}</h2>
                        <p class="animate__animated animate__fadeInUp">{{ $ban->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>
</section><!-- End Hero -->