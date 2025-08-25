@extends('layouts.app')

@section('title', 'Visi & Misi – Desa Ulukalo')

@section('content')

    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Visi &amp; Misi Desa Ulukalo</h1>
                        <p class="mb-0">
                            Komitmen Desa Ulukalo dalam mewujudkan masyarakat yang maju, mandiri, sehat dan sejahtera
                            melalui tata kelola pemerintahan yang transparan dan pembangunan berkelanjutan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('sejarah') }}">Profil</a></li>
                    <li class="current">Visi &amp; Misi</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="visi-misi" class="section">
        <div class="container">

            <div class="row g-4 align-items-stretch mb-5">
                <div class="col-lg-5">
                    <div class="h-100 p-4 p-lg-5 border rounded-4 bg-primary bg-gradient text-white">
                        <span class="text-uppercase text-white-50 small d-block mb-3">
                            <i class="bi bi-eye me-2"></i>Visi Desa Ulukalo
                        </span>
                        <h2 class="mt-2 mb-4 fw-bold">
                            "Terwujudnya Masyarakat Desa Ulukalo yang Maju, Mandiri, Sehat dan Sejahtera"
                        </h2>
                        <div class="row text-center mt-4">
                            <div class="col-6 col-sm-3 mb-3">
                                <div class="p-2 bg-white bg-opacity-20 rounded-3">
                                    <i class="bi bi-graph-up-arrow fs-4 d-block mb-1"></i>
                                    <small class="fw-semibold">Maju</small>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3 mb-3">
                                <div class="p-2 bg-white bg-opacity-20 rounded-3">
                                    <i class="bi bi-person-check fs-4 d-block mb-1"></i>
                                    <small class="fw-semibold">Mandiri</small>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3 mb-3">
                                <div class="p-2 bg-white bg-opacity-20 rounded-3">
                                    <i class="bi bi-heart-pulse fs-4 d-block mb-1"></i>
                                    <small class="fw-semibold">Sehat</small>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3 mb-3">
                                <div class="p-2 bg-white bg-opacity-20 rounded-3">
                                    <i class="bi bi-emoji-smile fs-4 d-block mb-1"></i>
                                    <small class="fw-semibold">Sejahtera</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="h-100 p-4 p-lg-5 border rounded-4">
                        <span class="text-uppercase text-muted small d-block mb-3">
                            <i class="bi bi-target me-2"></i>Misi Desa Ulukalo
                        </span>
                        <div class="row row-cols-1 g-3">
                            <div class="col">
                                <div class="d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">1</span>
                                    <p class="mb-0 small">
                                        <strong>Optimalisasi Kinerja Perangkat:</strong> Mengoptimalkan kinerja perangkat desa
                                        sesuai tugas pokok dan fungsi demi tercapainya pelayanan yang baik bagi masyarakat.
                                    </p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">2</span>
                                    <p class="mb-0 small">
                                        <strong>Responsivitas Pemerintahan:</strong> Menciptakan pemerintah desa yang cepat tanggap
                                        terhadap keadaan dan aspirasi masyarakat dengan terjun langsung melihat kondisi masyarakat
                                        di seluruh wilayah desa Ulukalo.
                                    </p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">3</span>
                                    <p class="mb-0 small">
                                        <strong>Koordinasi Kelembagaan:</strong> Koordinasi dan bekerja sama dengan semua unsur
                                        kelembagaan desa, lembaga keagamaan dan lembaga sosial politik untuk memberikan pelayanan
                                        terbaik dalam bidang keagamaan, pendidikan, ekonomi, sosial, politik, budaya, olahraga,
                                        ketertiban, dan keamanan.
                                    </p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">4</span>
                                    <p class="mb-0 small">
                                        <strong>Pengembangan SDM & SDA:</strong> Meningkatkan sumber daya manusia dan
                                        memanfaatkan sumber daya alam untuk mencapai kesejahteraan masyarakat.
                                    </p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-start">
                                    <span class="badge bg-primary rounded-pill me-3 mt-1">5</span>
                                    <p class="mb-0 small">
                                        <strong>Penguatan Kelembagaan:</strong> Meningkatkan kapasitas kelembagaan yang ada
                                        di desa Ulukalo.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <h2 class="section-heading text-center mb-4">Misi Lanjutan</h2>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col">
                        <div class="p-4 border rounded-4 h-100">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-success rounded-pill me-3 mt-1">6</span>
                                <div>
                                    <h6 class="fw-bold mb-2">Peningkatan Kesehatan</h6>
                                    <p class="mb-0 small text-muted">
                                        Meningkatkan kualitas kesehatan masyarakat melalui program-program kesehatan
                                        yang komprehensif dan berkelanjutan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-4 border rounded-4 h-100">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-success rounded-pill me-3 mt-1">7</span>
                                <div>
                                    <h6 class="fw-bold mb-2">Partisipasi Masyarakat</h6>
                                    <p class="mb-0 small text-muted">
                                        Meningkatkan kesejahteraan masyarakat dengan melibatkan secara langsung seluruh
                                        masyarakat desa Ulukalo dalam berbagai bentuk kegiatan pembangunan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-4 border rounded-4 h-100">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-success rounded-pill me-3 mt-1">8</span>
                                <div>
                                    <h6 class="fw-bold mb-2">Transparansi Pembangunan</h6>
                                    <p class="mb-0 small text-muted">
                                        Melaksanakan kegiatan pembangunan yang jujur, baik, transparan dan bertanggung jawab
                                        dengan akuntabilitas penuh kepada masyarakat.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-4 border rounded-4 h-100">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-success rounded-pill me-3 mt-1">9</span>
                                <div>
                                    <h6 class="fw-bold mb-2">Optimalisasi Sektor Unggulan</h6>
                                    <p class="mb-0 small text-muted">
                                        Mengoptimalkan pemanfaatan sumber daya alam yang ada, baik sektor pertanian
                                        maupun peternakan sebagai basis ekonomi desa.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="p-4 border rounded-4 h-100 bg-light">
                            <h3 class="section-heading h4 mb-3">
                                <i class="bi bi-bullseye text-primary me-2"></i>Tujuan Strategis
                            </h3>
                            <ul class="mb-0">
                                <li class="mb-2">Meningkatnya kualitas hidup dan kesejahteraan warga melalui optimalisasi potensi lokal</li>
                                <li class="mb-2">Terwujudnya tata kelola pemerintahan desa yang akuntabel dan responsif</li>
                                <li class="mb-2">Penguatan ekonomi keluarga berbasis pertanian dan peternakan berkelanjutan</li>
                                <li class="mb-2">Peningkatan akses dan kualitas layanan dasar (kesehatan, pendidikan, infrastruktur)</li>
                                <li class="mb-0">Terciptanya harmoni sosial dan partisipasi aktif masyarakat dalam pembangunan</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-4 border rounded-4 h-100">
                            <h3 class="section-heading h4 mb-3">
                                <i class="bi bi-graph-up text-success me-2"></i>Sasaran & Indikator
                            </h3>
                            <ul class="mb-0">
                                <li class="mb-2">Indeks kepuasan pelayanan administrasi desa mencapai minimal 85%</li>
                                <li class="mb-2">Peningkatan produktivitas sektor pertanian dan peternakan sebesar 15% per tahun</li>
                                <li class="mb-2">Tercapainya akses air bersih, infrastruktur jalan, dan konektivitas internet di semua dusun</li>
                                <li class="mb-2">Menurunnya angka kemiskinan dan meningkatnya partisipasi masyarakat dalam UMKM</li>
                                <li class="mb-0">Terlaksananya program kesehatan preventif dengan cakupan 100% keluarga</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center p-4 bg-primary bg-gradient rounded-4 text-white mb-5">
                <h4 class="mb-3">Komitmen Kepemimpinan</h4>
                <p class="mb-0">
                    "Dengan semangat gotong royong dan transparansi, kami berkomitmen mewujudkan Desa Ulukalo
                    yang maju, mandiri, sehat, dan sejahtera bagi seluruh masyarakat dari berbagai latar belakang suku dan budaya."
                </p>
                <div class="mt-3">
                    <small class="text-white-50">— Pemerintah Desa Ulukalo —</small>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('struktur') }}" class="btn btn-dark me-2">
                    <i class="bi bi-people me-2"></i>Lihat Struktur Desa
                </a>
                <a href="{{ route('surat') }}" class="btn btn-outline-dark">
                    <i class="bi bi-envelope me-2"></i>Layanan Surat Desa
                </a>
            </div>

        </div>
    </section>
@endsection
