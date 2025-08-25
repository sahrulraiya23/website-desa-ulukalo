@extends('layouts.app')

@section('title', 'Struktur Desa – Desa Ulukalo')

@section('content')

    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Struktur Organisasi Pemerintahan Desa (SOTK)</h1>
                        <p class="mb-0">
                            Susunan organisasi dan tugas pokok perangkat Desa Ulukalo sebagai dasar tata kelola pemerintahan
                            dan pelayanan masyarakat.
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
                    <li class="current">Struktur Desa</li>
                </ol>
            </div>
        </nav>
    </div>
    <section id="sotk" class="section">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    {{-- Menggunakan helper asset() untuk path gambar --}}
                    <img src="{{ asset('assets/img/struktur/bagan-sotk.png') }}"
                        alt="Bagan Struktur Pemerintahan Desa Ulukalo" class="img-fluid rounded-4 border">
                </div>
                <div class="col-lg-6">
                    <div class="p-4 p-lg-5 border rounded-4">
                        <h3 class="h4">Gambaran Umum</h3>
                        <p>
                            Struktur dasar Desa Ulukalo terdiri dari <strong>Kepala Desa</strong> yang dibantu
                            oleh <strong>Sekretaris Desa</strong>, unsur <strong>Kepala Seksi (Kasi)</strong>,
                            <strong>Kepala Urusan (Kaur)</strong>, serta <strong>Kepala Dusun (Kadus)</strong>.
                        </p>
                        <ul class="mb-0">
                            <li>Kepala Desa</li>
                            <li>Sekretaris Desa</li>
                            <li>Kasi Pemerintahan • Kasi Kesejahteraan • Kasi Pelayanan</li>
                            <li>Kaur Umum &amp; Perencanaan • Kaur Keuangan</li>
                            <li>Kepala Dusun I, II, III, … (sesuaikan jumlah dusun)</li>
                        </ul>
                        <div class="mt-4">
                            {{-- Menggunakan route placeholder --}}
                            <a href="{{-- route('pemerintahan') --}}#" class="btn btn-dark">Lihat Aparat &amp; Kepala Dusun</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="tugas" class="section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="h-100 p-4 border rounded-4">
                        <h4 class="h5 mb-2"><i class="bi bi-person-badge me-2"></i>Kepala Desa</h4>
                        <ul class="small mb-0">
                            <li>Pimpinan penyelenggaraan pemerintahan desa.</li>
                            <li>Penetapan kebijakan & pengambilan keputusan strategis.</li>
                            <li>Koordinasi pembangunan & pemberdayaan masyarakat.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="h-100 p-4 border rounded-4">
                        <h4 class="h5 mb-2"><i class="bi bi-briefcase me-2"></i>Sekretaris Desa</h4>
                        <ul class="small mb-0">
                            <li>Koordinasi administrasi & tata naskah dinas.</li>
                            <li>Pengelolaan arsip, kepegawaian, dan pelayanan umum.</li>
                            <li>Mendukung pelaksanaan kebijakan Kepala Desa.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="h-100 p-4 border rounded-4">
                        <h4 class="h5 mb-2"><i class="bi bi-diagram-3 me-2"></i>Kasi Pemerintahan</h4>
                        <ul class="small mb-0">
                            <li>Urusan kependudukan, pertanahan, dan ketertiban.</li>
                            <li>Fasilitasi musyawarah & produk hukum desa.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="h-100 p-4 border rounded-4">
                        <h4 class="h5 mb-2"><i class="bi bi-heart-pulse me-2"></i>Kasi Kesejahteraan</h4>
                        <ul class="small mb-0">
                            <li>Program sosial, pendidikan, kesehatan, kebudayaan.</li>
                            <li>Pemberdayaan masyarakat dan kelompok rentan.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="h-100 p-4 border rounded-4">
                        <h4 class="h5 mb-2"><i class="bi bi-people me-2"></i>Kasi Pelayanan</h4>
                        <ul class="small mb-0">
                            <li>Pelayanan administrasi harian & informasi publik.</li>
                            <li>Pengelolaan layanan surat keterangan.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="h-100 p-4 border rounded-4">
                        <h4 class="h5 mb-2"><i class="bi bi-journal-text me-2"></i>Kaur Umum &amp; Perencanaan</h4>
                        <ul class="small mb-0">
                            <li>Administrasi umum, aset, dan perencanaan program.</li>
                            <li>Dokumen RPJMDes/RKPDes & monitoring.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="h-100 p-4 border rounded-4">
                        <h4 class="h5 mb-2"><i class="bi bi-cash-coin me-2"></i>Kaur Keuangan</h4>
                        <ul class="small mb-0">
                            <li>Pengelolaan APBDes (perencanaan–pelaksanaan–pelaporan).</li>
                            <li>Penatausahaan, verifikasi, dan pertanggungjawaban.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="h-100 p-4 border rounded-4">
                        <h4 class="h5 mb-2"><i class="bi bi-signpost-2 me-2"></i>Kepala Dusun</h4>
                        <ul class="small mb-0">
                            <li>Koordinasi di tingkat dusun & pendataan warga.</li>
                            <li>Menjembatani aspirasi & pelaksanaan program di dusun.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="h-100 p-4 border rounded-4 text-center d-flex flex-column justify-content-center">
                        <h4 class="h5 mb-3"><i class="bi bi-images me-2"></i>Foto & Profil Pejabat</h4>
                        <p class="small">Lihat daftar lengkap nama & foto perangkat desa serta kepala dusun.</p>
                        {{-- Menggunakan route placeholder --}}
                        <a href="{{-- route('pemerintahan') --}}#" class="btn btn-outline-dark">Ke Halaman Aparat & Kadus</a>
                    </div>
                </div>
            </div>
        </div>
</section>@endsection
