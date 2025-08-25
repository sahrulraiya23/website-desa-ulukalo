@extends('layouts.app')

@section('title', 'Potensi Desa - Website Desa Ulu Kalo')

@section('content')
    <main class="main">
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Potensi Desa</h1>
                            <p class="mb-0">Sumber daya alam, ekonomi, dan sosial yang dimiliki Desa Ulu Kalo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section id="potensi-content" class="potensi-content section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Potensi Unggulan</h2>
                        <p>
                            (Konten mengenai potensi desa akan ditampilkan di sini. Anda bisa mengelolanya melalui halaman
                            admin.)
                        </p>

                        {{-- Tampilkan data dari database jika ada --}}
                        {{-- @if (isset($potential))
                        {!! $potential->content !!}
                    @endif --}}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
