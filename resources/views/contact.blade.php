@extends('template.home')

@section('title', 'Home')

@section('section-main')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Contact</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Contact</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <section id="contact" class="contact">
        <div class="container">

            <div class="row mt-5">

                <div class="col-lg-4">
                    <div class="info">
                        <div class="address">
                            <i class="icofont-google-map"></i>
                            <h4>Location:</h4>
                            <p>Jl. Raya Kampus Udayana No.20, Jimbaran</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="info">
                        <div class="address">
                            <i class="icofont-envelope"></i>
                            <h4>Email:</h4>
                            <p>info@stikom-bali.ac.id</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="info">
                        <div class="address">
                            <i class="icofont-phone"></i>
                            <h4>Call:</h4>
                            <p>0811-3881-288</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Team</h2>
                <p>Our Hardowrking Team</p>
            </div>

            <div class="row">

                <div class="col-lg-6">
                    <div class="member d-flex align-items-start">
                        <div class="pic"><img src="https://ik.imagekit.io/prbydmwbm8c/dummy-profile-pic_10R7S25OM.png"
                                class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>Ari Yoga</h4>
                            <span>Penulis 1</span>
                            <p>Saya Ari Yoga sebagai Penulis 1 pada Project ini.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="member d-flex align-items-start">
                        <div class="pic"><img src="https://ik.imagekit.io/prbydmwbm8c/dummy-profile-pic_10R7S25OM.png"
                                class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>Aditya</h4>
                            <span>Penulis 2</span>
                            <p>Saya Aditya Sebagai penulis 2 pada Project ini.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Team Section -->

</main><!-- End #main -->
@endsection