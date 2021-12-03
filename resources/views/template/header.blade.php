<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

        <h1 class="logo"><a href="{{ route('home') }}">STIKOM BALI</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav class="nav-menu d-none d-lg-block">

            <ul>
                <li class="{{request()->is('/') ? ' active' : '' }}"><a href="{{ route('home') }}">Home</a></li>

                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>

            </ul>

        </nav><!-- .nav-menu -->

        <a href="https://siap.stikom-bali.ac.id/#daftar" class="get-started-btn ml-auto">Daftar Mahasiswa Baru</a>

    </div>
</header><!-- End Header -->