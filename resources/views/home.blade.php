@extends('layouts.app')

@section('title', 'Beranda – Website Resmi Desa Ulukalo')

@section('content')

    <section id="hero" class="hero section"
        style="
        background-image: linear-gradient(rgba(255,255,255,0.2), rgba(255,255,255,0.2)), url('{{ asset('assets/img/hero/desa-ulukalo.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        filter: brightness(1.2);
    ">
        <div class="hero-container">
            <div class="hero-content">
                <h1>Selamat Datang di Website Resmi<br>Desa Ulukalo</h1>
                <p>Informasi profil desa, kegiatan pemerintahan, layanan administrasi, dan transparansi pengelolaan APBDes.
                </p>
                <div class="cta-buttons">
                    <a href="{{ route('surat') }}" class="btn-apply">Buat Layanan Surat</a>
                    {{-- Ganti '#' dengan route('apbdes') jika sudah dibuat --}}
                    <a href="#" class="btn-tour">Lihat APBDes</a>
                </div>
                <div class="announcement">
                    <div class="announcement-badge">Info</div>
                    <p>Jam pelayanan kantor: Senin–Jumat 08.00–15.00 WITA</p>
                </div>
            </div>
        </div>

        <div class="highlights-container container">
            <div class="row gy-4">
                <div class="col-md-4">
                    <div class="highlight-item">
                        <div class="icon"><i class="bi bi-people-fill"></i></div>
                        <h3>Pelayanan Mudah</h3>
                        <p>Layanan surat bisa diisi online, unduh langsung dalam format PDF.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="highlight-item">
                        <div class="icon"><i class="bi bi-shield-check"></i></div>
                        <h3>Transparan</h3>
                        <p>Publikasi APBDes dan realisasi anggaran secara berkala.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="highlight-item">
                        <div class="icon"><i class="bi bi-buildings"></i></div>
                        <h3>Informasi Desa</h3>
                        <p>Profil, sejarah, visi misi, dan struktur organisasi desa.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="about" class="about section">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-6">
                    <div class="content">
                        <h3>Sekilas Desa Ulukalo</h3>
                        <p>Desa Ulukalo berada di Kabupaten Kolaka. Kami berkomitmen menghadirkan pemerintahan desa yang
                            akuntabel, pelayanan publik yang cepat, dan partisipasi warga yang luas dalam pembangunan.</p>

                        <div class="stats-row">
                            <div class="stat-item">
                                <div class="number purecounter" data-purecounter-start="0" data-purecounter-end="3"
                                    data-purecounter-duration="1">0</div>
                                <div class="label">Dusun</div>
                            </div>
                            <div class="stat-item">
                                <div class="number purecounter" data-purecounter-start="0" data-purecounter-end="12"
                                    data-purecounter-duration="1">0</div>
                                <div class="label">RT</div>
                            </div>
                            <div class="stat-item">
                                <div class="number purecounter" data-purecounter-start="0" data-purecounter-end="100"
                                    data-purecounter-duration="1">0</div>
                                <div class="label">Kegiatan/Tahun</div>
                            </div>
                        </div>

                        <a href="{{ route('sejarah') }}" class="btn-learn-more">
                            Baca Profil Lengkap
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="image-wrapper">
                        <img src="{{ asset('assets/img/hero/desa-ulukalo.jpg') }}" alt="Gambar Desa" class="img-fluid"
                            loading="lazy">
                        <div class="experience-badge">
                            <div class="years">Ulukalo</div>
                            <div class="text">Kab. Kolaka</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="featured-programs section">
        <div class="container section-title">
            <h2>Layanan Utama</h2>
            <p>Pintasan cepat ke halaman yang sering diakses warga.</p>
        </div>

        <div class="container">
            <div class="featured-programs-wrapper">
                <div class="programs-showcase">
                    <div class="programs-list">

                        <div class="program-item">
                            <div class="item-visual">
                                <img src="{{ asset('assets/img/layanan.png') }}" alt="Layanan Surat"
                                    class="img-fluid" loading="lazy">
                            </div>
                            <div class="item-details">
                                <div class="item-category">Administrasi</div>
                                <h4>Layanan Surat</h4>
                                <p>Buat SKU, SKTM, SK Berkelakuan Baik, dan SK Belum Menikah secara online.</p>
                                <div class="item-info"><span>PDF otomatis</span><span>Form mudah</span></div>
                            </div>
                            <a class="item-action" href="{{ route('surat') }}" aria-label="Layanan Surat">
                                <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        </div>

                        <div class="program-item">
                            <div class="item-visual">
                                <img src="{{ asset('assets/img/logo_apbdes.jpg') }}" alt="APBDes" class="img-fluid"
                                    loading="lazy">
                            </div>
                            <div class="item-details">
                                <div class="item-category">Transparansi</div>
                                <h4>APBDes</h4>
                                <p>Ringkasan anggaran, program kerja, dan realisasi pelaksanaan tahun berjalan.</p>
                                <div class="item-info"><span>Data publik</span><span>Terbaru</span></div>
                            </div>
                            {{-- Ganti '#' dengan route('apbdes') jika sudah dibuat --}}
                            <a class="item-action" href="#" aria-label="APBDes">
                                <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        </div>



                        <div class="program-item">
                            <div class="item-visual">
                                <img src="{{ asset('assets/img/logo_aparat.jpg') }}" alt="Pemerintahan" class="img-fluid"
                                    loading="lazy">
                            </div>
                            <div class="item-details">
                                <div class="item-category">Pemerintahan</div>
                                <h4>Aparat &amp; Kadus</h4>
                                <p>Informasi dan kontak singkat aparat desa dan kepala dusun.</p>
                                <div class="item-info"><span>Pelayanan</span><span>Responsif</span></div>
                            </div>
                            {{-- Ganti '#' dengan route('pemerintahan') jika sudah dibuat --}}
                            <a class="item-action" href="#" aria-label="Pemerintahan">
                                <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
