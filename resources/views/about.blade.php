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
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro odio id iure. Expedita amet deleniti
                    eaque iusto commodi blanditiis nihil dolor minus temporibus? Officiis quia nisi porro optio dolores
                    cumque.</p>
            </div>

        </div>
    </section>

</main><!-- End #main -->
@endsection