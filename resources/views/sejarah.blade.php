@extends('layouts.app')

@section('title', 'Sejarah Desa – Desa Ulukalo')

@section('content')

    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Sejarah Desa Ulukalo</h1>
                        <p class="mb-0">
                            Perjalanan panjang Desa Ulukalo dari sebuah dusun kecil hingga menjadi desa yang berkembang
                            di Kecamatan Iwoimendaa, Kabupaten Kolaka.
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
                    <li class="current">Sejarah Desa</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="sejarah" class="section">
        <div class="container">

            <div class="row g-4 align-items-start mb-5">
                <div class="col-lg-8">
                    <h2 class="section-heading">Asal-Usul & Pembentukan Desa</h2>
                    <p class="section-text">
                        Desa Ulukalo memiliki sejarah yang tidak dapat dipisahkan dari perkembangan Kecamatan Iwoimendaa.
                        Sebelum resmi menjadi sebuah desa yang mandiri, wilayah Ulukalo awalnya hanya merupakan salah satu
                        dusun dari Desa Iwoimendaa yang berkembang secara bertahap.
                    </p>

                    <p class="section-text">
                        Pada tahun 1982, seiring dengan pertumbuhan penduduk dan perkembangan wilayah, dusun ini kemudian
                        dimekarkan dan dibentuk menjadi desa tersendiri. Pembentukan Desa Ulukalo diresmikan berdasarkan
                        <strong>Peraturan Bupati Nomor 08/120/1982 Tahun 1982</strong>, menjadikannya salah satu dari
                        10 desa yang ada di Kecamatan Iwoimendaa.
                    </p>

                    <h3 class="mt-4">Perkembangan Kepemimpinan</h3>
                    <p>
                        Sejak berdiri pada tahun 1982, Desa Ulukalo telah dipimpin oleh lima kepala desa yang berperan
                        penting dalam membangun dan mengembangkan desa. Setiap periode kepemimpinan membawa kemajuan
                        tersendiri bagi masyarakat Ulukalo.
                    </p>
                </div>

                <div class="col-lg-4">
                    <div class="p-4 border rounded-3 h-100">
                        <h5 class="mb-3"><i class="bi bi-info-circle me-2"></i>Fakta Singkat</h5>
                        <ul class="list-unstyled mb-0 small">
                            <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Luas Wilayah: <strong>406,07 ha</strong></li>
                            <li class="mb-2"><i class="bi bi-diagram-3 me-2"></i>Jumlah Dusun: <strong>6 dusun</strong></li>
                            <li class="mb-2"><i class="bi bi-people me-2"></i>Jumlah Penduduk: <strong>1.249 jiwa (2021)</strong></li>
                            <li class="mb-2"><i class="bi bi-calendar-event me-2"></i>Tahun Berdiri: <strong>1982</strong></li>
                            <li class="mb-2"><i class="bi bi-house me-2"></i>Jumlah KK: <strong>325 KK</strong></li>
                            <li class="mb-2"><i class="bi bi-map me-2"></i>Jarak ke Kecamatan: <strong>3 km</strong></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <h2 class="section-heading">Linimasa Kepemimpinan Desa</h2>
                <div class="row row-cols-1 row-cols-lg-2 g-4 mt-1">
                    <div class="col">
                        <div class="border rounded-3 p-3 h-100">
                            <span class="badge bg-primary mb-2">1982 - 1999</span>
                            <h6 class="mb-1">BACTIAR</h6>
                            <p class="mb-0 small text-muted">Kepala Desa pertama yang memimpin pembangunan fondasi desa.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border rounded-3 p-3 h-100">
                            <span class="badge bg-primary mb-2">1999 - 2009</span>
                            <h6 class="mb-1">ACHMAD NOER. P</h6>
                            <p class="mb-0 small text-muted">Melanjutkan pembangunan infrastruktur dan pelayanan masyarakat.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border rounded-3 p-3 h-100">
                            <span class="badge bg-primary mb-2">2009 - 2014</span>
                            <h6 class="mb-1">M. ALI. L</h6>
                            <p class="mb-0 small text-muted">Fokus pada pengembangan sektor pertanian dan perkebunan.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border rounded-3 p-3 h-100">
                            <span class="badge bg-primary mb-2">2014 - 2019</span>
                            <h6 class="mb-1">DARMAWAN</h6>
                            <p class="mb-0 small text-muted">Periode modernisasi administrasi dan peningkatan SDM.</p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="border rounded-3 p-3 h-100 bg-light">
                            <span class="badge bg-success mb-2">2019 - Sekarang</span>
                            <h6 class="mb-1">NASRUDDIN, SH</h6>
                            <p class="mb-0 small text-muted">Kepala Desa aktif yang fokus pada digitalisasi dan peningkatan kesejahteraan masyarakat.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <h2 class="section-heading">Geografi & Batas Wilayah</h2>
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="border rounded-3 p-3 h-100">
                            <h6 class="text-uppercase text-muted mb-3"><i class="bi bi-compass me-2"></i>Batas Administratif</h6>
                            <ul class="mb-0">
                                <li class="mb-2"><strong>Utara:</strong> Desa Lasiroku</li>
                                <li class="mb-2"><strong>Timur:</strong> Desa Wonualaku</li>
                                <li class="mb-2"><strong>Selatan:</strong> Desa Landoula</li>
                                <li class="mb-2"><strong>Barat:</strong> Desa Iwoimendaa</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="border rounded-3 p-3 h-100">
                            <h6 class="text-uppercase text-muted mb-3"><i class="bi bi-geo-alt me-2"></i>Koordinat Geografis</h6>
                            <div class="mb-3">
                                <small class="text-muted d-block">Lintang Selatan</small>
                                <strong>4°28'3" - 4°28'29" LS</strong>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-block">Bujur Timur</small>
                                <strong>121°36'41" - 121°56'39" BT</strong>
                            </div>
                            <div>
                                <small class="text-muted d-block">Ketinggian</small>
                                <strong>41 - 157 mdpl</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <h2 class="section-heading">Kondisi Geografis & Topografi</h2>
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="border rounded-3 p-4 h-100">
                            <h6 class="text-uppercase text-muted mb-3">Karakteristik Wilayah</h6>
                            <p class="mb-3">
                                Desa Ulukalo memiliki kondisi topografi yang bervariasi, mulai dari daerah perbukitan
                                hingga dataran rendah dengan ketinggian yang berkisar antara 41 hingga 157 meter di atas
                                permukaan laut. Kondisi geografis yang beragam ini memberikan potensi yang baik untuk
                                pengembangan berbagai sektor.
                            </p>
                            <p class="mb-0">
                                Kesuburan tanah di desa ini menjadi daya tarik utama bagi pendatang, terutama dari
                                Sulawesi Selatan, untuk menetap dan mengembangkan usaha pertanian dan perkebunan.
                                Hal ini juga yang menyebabkan pertumbuhan penduduk yang stabil dari tahun ke tahun.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="border rounded-3 p-4 h-100">
                            <h6 class="text-uppercase text-muted mb-3">Pemanfaatan Lahan</h6>
                            <ul class="list-unstyled mb-0 small">
                                <li class="mb-2">Perkebunan: <strong>201,82 ha</strong></li>
                                <li class="mb-2">Pertanian: <strong>46 ha</strong></li>
                                <li class="mb-2">Pemukiman: <strong>30 ha</strong></li>
                                <li class="mb-2">Pekarangan: <strong>8,25 ha</strong></li>
                                <li class="mb-2">Pengembangan: <strong>120 ha</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <h2 class="section-heading">Perkembangan Demografis</h2>
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="border rounded-3 p-4 h-100">
                            <h6 class="text-uppercase text-muted mb-3">Pertumbuhan Penduduk</h6>
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="border-end pe-3">
                                        <h4 class="text-primary mb-1">803</h4>
                                        <small class="text-muted">Jiwa (1982)</small>
                                        <div><small>175 KK</small></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="ps-3">
                                        <h4 class="text-success mb-1">1.249</h4>
                                        <small class="text-muted">Jiwa (2021)</small>
                                        <div><small>325 KK</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="border rounded-3 p-4 h-100">
                            <h6 class="text-uppercase text-muted mb-3">Keberagaman Suku</h6>
                            <p class="mb-3 small">
                                Desa Ulukalo dihuni oleh 5 suku yang hidup harmonis, didominasi oleh Suku Tolaki
                                dan Bugis. Keberagaman ini menciptakan kekayaan budaya dan tradisi yang unik.
                            </p>
                            <span class="badge bg-outline-primary me-2 mb-2">Tolaki</span>
                            <span class="badge bg-outline-primary me-2 mb-2">Bugis</span>
                            <span class="badge bg-outline-primary me-2 mb-2">Dan 3 suku lainnya</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <h2 class="section-heading">Pembagian Wilayah Administratif</h2>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                    <div class="col">
                        <div class="border rounded-3 p-3 text-center">
                            <h6 class="mb-1">Dusun I</h6>
                            <p class="mb-1"><strong>Polewali</strong></p>
                            <small class="text-muted">21 Ha</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border rounded-3 p-3 text-center">
                            <h6 class="mb-1">Dusun II</h6>
                            <p class="mb-1"><strong>Wawoneha</strong></p>
                            <small class="text-muted">16,64 Ha</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border rounded-3 p-3 text-center">
                            <h6 class="mb-1">Dusun III</h6>
                            <p class="mb-1"><strong>Onembute</strong></p>
                            <small class="text-muted">25,18 Ha</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border rounded-3 p-3 text-center">
                            <h6 class="mb-1">Dusun IV</h6>
                            <p class="mb-1"><strong>Lapokko</strong></p>
                            <small class="text-muted">72 Ha</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border rounded-3 p-3 text-center">
                            <h6 class="mb-1">Dusun V</h6>
                            <p class="mb-1"><strong>Mepokoaso</strong></p>
                            <small class="text-muted">129,75 Ha</small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border rounded-3 p-3 text-center">
                            <h6 class="mb-1">Dusun VI</h6>
                            <p class="mb-1"><strong>Uluiwoi</strong></p>
                            <small class="text-muted">141,5 Ha</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-info">
                <h6 class="alert-heading"><i class="bi bi-info-circle me-2"></i>Visi Masa Depan</h6>
                <p class="mb-0">
                    Dengan sejarah panjang dan perkembangan yang konsisten selama lebih dari 40 tahun,
                    Desa Ulukalo terus berkomitmen untuk meningkatkan kesejahteraan masyarakat melalui
                    pembangunan berkelanjutan dengan tetap melestarikan nilai-nilai budaya dan kearifan lokal.
                </p>
            </div>

        </div>
    </section>
@endsection
