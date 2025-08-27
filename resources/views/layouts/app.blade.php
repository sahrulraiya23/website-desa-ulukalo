<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Menggunakan @yield untuk judul dinamis, dengan default dari template baru --}}
    <title>@yield('title', 'Beranda – Desa Ulukalo')</title>

    {{-- Meta tags dari template baru --}}
    <meta name="description"
        content="Website resmi Desa Ulukalo, Kabupaten Kolaka. Profil desa, pemerintahan, layanan surat, dan transparansi APBDes.">
    <meta name="keywords" content="Desa Ulukalo, Pemerintahan Desa, Layanan Surat, APBDes, Struktur Desa">

    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    {{-- Menambahkan AOS dari template lama jika masih diperlukan, jika tidak bisa dihapus --}}
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">


    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                <i class="bi bi-bank"></i>
                <h1 class="sitename">Desa Ulukalo</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    {{-- Link Beranda --}}
                    <li><a href="{{ route('home') }}"
                            class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>

                    {{-- Dropdown Profil --}}
                    <li class="dropdown">
                        {{-- Logika untuk 'active' pada dropdown: aktif jika salah satu rute di dalamnya aktif --}}
                        <a href="#"
                            class="{{ request()->routeIs(['sejarah', 'visi-misi', 'struktur']) ? 'active' : '' }}">
                            <span>Profil</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
                        </a>
                        <ul>
                            <li><a href="{{ route('sejarah') }}">Sejarah Desa</a></li>
                            <li><a href="{{ route('visi-misi') }}">Visi &amp; Misi</a></li>
                            <li><a href="{{ route('struktur') }}">Struktur Desa</a></li>
                        </ul>
                    </li>

                    {{-- Dropdown Pemerintahan (Asumsi nama rute 'pemerintahan') --}}
                    <li class="dropdown">
                        <a href="#" class="{{ request()->routeIs(['aparat-desa']) ? 'active' : '' }}">
                            <span>Pemerintahan</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
                        </a>
                        <ul>
                            <li><a href="{{ route('aparat-desa.index') }}">Aparat Desa &amp; Kadus</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ route('apbdes.index') }}#" class="{{-- request()->routeIs('apbdes') ? 'active' : '' --}}">APBDes</a></li>
                    <li><a href="{{ route('surat') }}"
                            class="{{ request()->routeIs('surat') ? 'active' : '' }}">Layanan Surat</a></li>
                    <li><a href="{{ route('kontak') }}#" class="{{-- request()->routeIs('kontak') ? 'active' : '' --}}">Kontak</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>

    <main class="main">
        {{-- Konten utama halaman akan dimuat di sini --}}
        @yield('content')
    </main>
    <footer id="footer" class="footer position-relative dark-background">
        <div class="container">
            <div class="footer-main">
                <div class="row align-items-start">
                    <div class="col-lg-6">
                        <div class="brand-section">
                            {{-- Menggunakan route('home') untuk link ke beranda --}}
                            <a href="{{ route('home') }}" class="logo d-flex align-items-center mb-3">
                                {{-- Menggunakan config('app.name') agar nama situs dinamis --}}
                                <span class="sitename">{{ config('app.name', 'Desa Ulukalo') }}</span>
                            </a>
                            <p class="brand-description">
                                Kantor Desa Ulukalo, Kabupaten Kolaka – Informasi profil, pemerintahan, layanan surat,
                                dan transparansi APBDes.
                            </p>
                            <div class="contact-info mt-3">
                                <div class="contact-item"><i class="bi bi-geo-alt"></i> Alamat kantor: [isi alamat]
                                </div>
                                <div class="contact-item"><i class="bi bi-telephone"></i> Telp/WA: [isi nomor]</div>
                                <div class="contact-item"><i class="bi bi-envelope"></i> Email: [isi email]</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-6">
                                <h6>Profil</h6>
                                <nav class="footer-nav">
                                    <a href="{{ route('sejarah') }}">Sejarah</a>
                                    <a href="{{ route('visi-misi') }}">Visi &amp; Misi</a>
                                    <a href="{{ route('struktur') }}">Struktur Desa</a>
                                </nav>
                            </div>
                            <div class="col-6">
                                <h6>Layanan</h6>
                                <nav class="footer-nav">
                                    {{-- Menggunakan route placeholder agar tidak error jika rute belum ada --}}
                                    <a href="{{-- route('pemerintahan') --}}#">Aparat &amp; Kadus</a>
                                    <a href="{{-- route('apbdes') --}}#">APBDes</a>
                                    <a href="{{ route('surat') }}">Layanan Surat</a>
                                    <a href="{{-- route('kontak') --}}#">Kontak</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom mt-4">
                <div class="bottom-content d-flex flex-wrap justify-content-between align-items-center">
                    <div class="copyright">
                        {{-- Menambahkan tahun dinamis dengan date('Y') --}}
                        <p>© {{ date('Y') }} <span
                                class="sitename">{{ config('app.name', 'Desa Ulukalo') }}</span> — Semua hak
                            dilindungi.</p>
                    </div>
                    <div class="legal-links">
                        <a href="{{-- route('kebijakan-privasi') --}}#">Kebijakan Privasi</a>
                        <a href="{{-- route('syarat-penggunaan') --}}#">Syarat Penggunaan</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    {{-- Menambahkan AOS dari template lama jika masih diperlukan --}}
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
