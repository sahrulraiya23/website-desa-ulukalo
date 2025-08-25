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
                            Rumusan arah pembangunan Desa Ulukalo untuk mewujudkan tata kelola yang baik,
                            pelayanan publik yang prima, dan kesejahteraan masyarakat yang berkelanjutan.
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
                    <div class="h-100 p-4 p-lg-5 border rounded-4 bg-light">
                        <span class="text-uppercase text-muted small">Visi</span>
                        <h2 class="mt-2">“[TULIS VISI RESMI DESA ULUKALO DI SINI]”</h2>
                        <p class="mb-0 text-secondary small">
                            *Catatan: Ganti teks dalam tanda kurung sesuai dokumen resmi desa.*
                        </p>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="h-100 p-4 p-lg-5 border rounded-4">
                        <span class="text-uppercase text-muted small">Misi</span>
                        <ol class="mt-2 ps-3">
                            <li class="mb-2">[Misi 1: contoh—Meningkatkan kualitas pelayanan publik yang cepat, tepat, dan
                                transparan.]</li>
                            <li class="mb-2">[Misi 2: contoh—Mendorong pertumbuhan ekonomi lokal berbasis potensi desa
                                (pertanian, UMKM, wisata, dll.).]</li>
                            <li class="mb-2">[Misi 3: contoh—Memperluas akses pendidikan, kesehatan, dan perlindungan
                                sosial bagi masyarakat rentan.]</li>
                            <li class="mb-2">[Misi 4: contoh—Membangun infrastruktur dasar yang merata dan berkelanjutan
                                di seluruh dusun.]</li>
                            <li class="mb-0">[Misi 5: contoh—Menguatkan partisipasi masyarakat dan kelembagaan desa dalam
                                perencanaan & pengawasan pembangunan.]</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="p-4 border rounded-4 h-100">
                            <h3 class="section-heading h4">Tujuan</h3>
                            <ul class="mb-0">
                                <li>Meningkatnya kualitas hidup dan kesejahteraan warga desa.</li>
                                <li>Terwujudnya tata kelola pemerintahan desa yang akuntabel.</li>
                                <li>Optimalisasi potensi lokal dan penguatan ekonomi keluarga.</li>
                                <li>Peningkatan kualitas lingkungan hidup dan ketahanan bencana.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-4 border rounded-4 h-100">
                            <h3 class="section-heading h4">Sasaran</h3>
                            <ul class="mb-0">
                                <li>Indeks kepuasan layanan administrasi desa meningkat.</li>
                                <li>Pertumbuhan unit usaha/UMKM dan serapan tenaga kerja lokal.</li>
                                <li>Pemenuhan akses air bersih, jalan lingkungan, dan internet dasar.</li>
                                <li>Ketersediaan data terpadu warga rentan dan intervensi terarah.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('struktur') }}" class="btn btn-dark me-2">
                    Lihat Struktur Desa
                </a>
                <a href="{{ route('surat') }}" class="btn btn-outline-dark">
                    Layanan Surat Desa
                </a>
            </div>

        </div>
</section>@endsection
