@extends('layouts.app')

@section('title', 'Peta Desa - Website Desa Ulu Kalo')

@section('content')
    <main class="main">
        <div class="page-title" data-aos="fade">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Peta Wilayah Desa</h1>
                            <p class="mb-0">Lokasi geografis dan batas wilayah Desa Ulu Kalo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section id="peta-content" class="peta-content section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        {{-- Ganti 'src' dengan kode embed dari Google Maps untuk peta desa Anda --}}
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.011680194953!2d106.8271523147693!3d-6.262263995468759!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3d3b463236d%3A0x2641f3e741f5313!2sMonumen%20Nasional!5e0!3m2!1sid!2sid!4v1620977855593!5m2!1sid!2sid"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

                        {{-- Tampilkan deskripsi dari database jika ada --}}
                        {{-- @if (isset($map))
                        <div class="mt-4">
                           {!! $map->description !!}
                        </div>
                    @endif --}}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
