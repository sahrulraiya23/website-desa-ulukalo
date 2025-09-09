<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

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

    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    {{-- CSS Footer Terpisah --}}
    <link href="{{ asset('assets/css/footer.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                <div class="header-container">
                    <img src="{{ asset('assets/img/logo_kolaka.png') }}" alt="Logo Kabupaten Kolaka"
                        class="logo-kolaka">
                    <h1 class="sitename">Desa Ulukalo</h1>
                </div>
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

                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>

    <main class="main">
        {{-- Konten utama halaman akan dimuat di sini --}}
        @yield('content')
    </main>

    <footer id="footer" class="footer position-relative">
        <div class="footer-waves">
            <svg viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                    opacity=".25" class="shape-fill"></path>
                <path
                    d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                    opacity=".5" class="shape-fill"></path>
                <path
                    d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
                    class="shape-fill"></path>
            </svg>
        </div>

        <div class="container">
            <div class="footer-main">
                <div class="row align-items-start">
                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="brand-section">
                            {{-- Menggunakan route('home') untuk link ke beranda --}}
                            <a href="{{ route('home') }}" class="logo d-flex align-items-center mb-4">
                                <div class="logo-icon me-3">
                                    <i class="bi bi-building-fill"></i>
                                </div>
                                {{-- Menggunakan config('app.name') agar nama situs dinamis --}}
                                <div>
                                    <span class="sitename">{{ config('app.name', 'Desa Ulukalo') }}</span>
                                    <div class="subtitle">Kabupaten Kolaka</div>
                                </div>
                            </a>
                            <p class="brand-description">
                                Kantor Desa Ulukalo, Kabupaten Kolaka – Menyediakan layanan informasi profil desa,
                                struktur pemerintahan, layanan administrasi surat, dan transparansi pengelolaan APBDes
                                untuk kemajuan dan kesejahteraan masyarakat.
                            </p>

                            <div class="contact-info mt-4">
                                <h6 class="contact-title mb-3">
                                    <i class="bi bi-geo-alt-fill me-2"></i>
                                    Hubungi Kami
                                </h6>
                                {{-- Ganti dengan data yang sebenarnya --}}
                                <div class="contact-item">
                                    <i class="bi bi-geo-alt contact-icon"></i>
                                    <div>
                                        <strong>Alamat:</strong><br>
                                        Desa Ulu Kalo, Kecamatan Iwoimendaa,<br> Kabupaten Kolaka, Provinsi Sulawesi
                                        Tenggara, 93552
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-telephone contact-icon"></i>
                                    <div>
                                        <strong>Telp/WA:</strong><br>
                                        <a href="tel:+6281xxxxxxxx">085283843758 (Ahmad S.pd)</a>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <i class="bi bi-envelope contact-icon"></i>
                                    <div>
                                        <strong>Email:</strong><br>
                                        <a href="mailto:pemdes@ulukalo.id">pemdes@ulukalo.id</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="row">
                            <div class="col-sm-6 mb-4">
                                <div class="footer-section">
                                    <h6 class="section-title">
                                        <i class="bi bi-info-circle-fill me-2"></i>
                                        Profil Desa
                                    </h6>
                                    <nav class="footer-nav">
                                        <a href="{{ route('sejarah') }}">
                                            <i class="bi bi-clock-history"></i>
                                            Sejarah Desa
                                        </a>
                                        <a href="{{ route('visi-misi') }}">
                                            <i class="bi bi-bullseye"></i>
                                            Visi &amp; Misi
                                        </a>

                                    </nav>
                                </div>
                            </div>

                            <div class="col-sm-6 mb-4">
                                <div class="footer-section">
                                    <h6 class="section-title">
                                        <i class="bi bi-gear-fill me-2"></i>
                                        Layanan
                                    </h6>
                                    <nav class="footer-nav">
                                        {{-- Pastikan rute ini sudah didefinisikan di web.php --}}
                                        <a href="{{ route('aparat-desa.index') }}">
                                            <i class="bi bi-people"></i>
                                            Aparat Desa
                                        </a>
                                        <a href="{{ route('apbdes.index') }}">
                                            <i class="bi bi-pie-chart"></i>
                                            APBDes
                                        </a>
                                        <a href="{{ route('surat') }}">
                                            <i class="bi bi-file-earmark-text"></i>
                                            Layanan Surat
                                        </a>

                                    </nav>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media Section -->
                        <div class="social-section mt-4">
                            <h6 class="section-title">
                                <i class="bi bi-share-fill me-2"></i>
                                Media Sosial
                            </h6>
                            <div class="social-links">
                                <a href="#" class="social-link facebook" title="Facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="#" class="social-link instagram" title="Instagram">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="#" class="social-link whatsapp" title="WhatsApp">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                                <a href="#" class="social-link youtube" title="YouTube">
                                    <i class="bi bi-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-divider"></div>

            <div class="footer-bottom">
                <div class="bottom-content d-flex flex-wrap justify-content-between align-items-center">
                    <div class="copyright">
                        {{-- Menambahkan tahun dinamis dengan date('Y') --}}
                        <p class="mb-1">
                            © {{ date('Y') }} <span
                                class="sitename">{{ config('app.name', 'Desa Ulukalo') }}</span>
                            <br class="d-sm-none">
                            <span class="text-muted">Semua hak dilindungi undang-undang</span>
                        </p>
                    </div>

                    <div class="developer-credit">
                        <p class="mb-1">
                            <span class="made-with">Dibuat dengan</span>
                            <i class="bi bi-heart-fill text-danger heartbeat"></i>
                            <span class="by">oleh</span>
                        </p>
                        <p class="developer-name">
                            <strong>Muhammad Saharullah Raiya</strong>
                        </p>
                    </div>

                    <div class="legal-links">
                        {{-- Jika rute belum ada, bisa dibiarkan '#' --}}
                        <a href="#" class="legal-link">
                            <i class="bi bi-shield-check"></i>
                            Kebijakan Privasi
                        </a>
                        <a href="#" class="legal-link">
                            <i class="bi bi-file-text"></i>
                            Syarat Penggunaan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <div id="preloader"></div>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
