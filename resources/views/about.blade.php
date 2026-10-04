@extends('template.home')

@section('title', 'Home')

@section('section-main')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>About</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>About</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="content">
                <h2>ITB STIKOM BALI</h2>
                <p>Institut Teknologi dan Bisnis (ITB) STIKOM Bali merupakan salah satu perguruan
                tinggi swasta yang bertempat di Bali dan bergerak pada bidang pengajaran Teknologi
                dan Bisnis dengan berbagai penghargaan dan prestasi yang dimiliki baik tingkat
                nasional maupun tingkat internasional. Institut Teknologi dan Bisnis (ITB) STIKOM
                Bali merupakan salah satu kampus IT di Bali yang berhasil menghasilkan lulusan
                lulusan dengan kualitas terbaik dan berguna untuk masyarakat.</p>
            </div>

        </div>
    </section>

</main><!-- End #main -->
@endsection