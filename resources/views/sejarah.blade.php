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
                            Ringkasan asal-usul penamaan, perkembangan administrasi, serta peristiwa penting yang
                            membentuk Desa Ulukalo hingga saat ini.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    {{-- Menggunakan route helper untuk link dinamis --}}
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
                    <h2 class="section-heading">Asal-Usul & Penamaan</h2>
                    <p class="section-text">
                        [TULIS ASAL-USUL DI SINI] Contoh pengganti: Nama “Ulukalo” diyakini berasal dari
                        <em>…(isi narasi lokal)…</em>. Pada masa awal, wilayah ini merupakan permukiman
                        yang tumbuh di sekitar … dan menjadi cikal bakal desa.
                    </p>

                    <h3 class="mt-4">Perkembangan Administrasi</h3>
                    <p>
                        [TULIS PERKEMBANGAN] Misalnya: awalnya berstatus dusun/kelurahan pada tahun …,
                        kemudian definitif menjadi desa pada tahun … berdasarkan SK … .
                    </p>
                </div>

                <div class="col-lg-4">
                    <div class="p-4 border rounded-3 h-100">
                        <h5 class="mb-3"><i class="bi bi-info-circle me-2"></i>Fakta Singkat</h5>
                        <ul class="list-unstyled mb-0 small">
                            <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Luas Wilayah: <strong>— ha</strong></li>
                            <li class="mb-2"><i class="bi bi-diagram-3 me-2"></i>Jumlah Dusun: <strong>—</strong></li>
                            <li class="mb-2"><i class="bi bi-people me-2"></i>Perkiraan Penduduk: <strong>— jiwa</strong>
                            </li>
                            <li class="mb-2"><i class="bi bi-calendar-event me-2"></i>Tahun Berdiri: <strong>—</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <h2 class="section-heading">Linimasa Peristiwa Penting</h2>
                <div class="row row-cols-1 row-cols-lg-3 g-4 mt-1">
                    <div class="col">
                        <div class="border rounded-3 p-3 h-100">
                            <span class="badge bg-dark mb-2">19xx</span>
                            <p class="mb-0">Awal pemukiman/penataan wilayah (isi peristiwa).</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border rounded-3 p-3 h-100">
                            <span class="badge bg-dark mb-2">199x</span>
                            <p class="mb-0">Penguatan struktur pemerintahan desa (isi peristiwa).</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="border rounded-3 p-3 h-100">
                            <span class="badge bg-dark mb-2">20xx</span>
                            <p class="mb-0">Pemekaran/penetapan batas wilayah (isi peristiwa).</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <h2 class="section-heading">Geografi & Batas Wilayah</h2>
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="border rounded-3 p-3 h-100">
                            <h6 class="text-uppercase text-muted mb-2">Batas</h6>
                            <ul class="mb-0">
                                <li>Utara: —</li>
                                <li>Timur: —</li>
                                <li>Selatan: —</li>
                                <li>Barat: —</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="border rounded-3 p-3 h-100">
                            <h6 class="text-uppercase text-muted mb-2">Kondisi Umum</h6>
                            <p class="mb-0">
                                [TULIS GAMBARAN SINGKAT] kondisi topografi, mata pencaharian utama,
                                aksesibilitas, dan potensi unggulan desa.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
