@extends('layouts.app')

@section('title', 'Pemerintahan – Aparat Desa & Kepala Dusun | Desa Ulukalo')

{{-- Menyisipkan CSS khusus untuk halaman ini ke dalam <head> layout --}}
@push('styles')
    <style>
        /* Sentuhan kecil biar kartu rapi */

        .aparat-card img {
            height: 400px;
            width: 100%;
            object-fit: cover;
        }


        .aparat-card .jabatan {
            font-size: .925rem;
            color: #6c757d;
        }

        .filter-wrap .form-control {
            height: 48px;
        }

        .empty-state {
            border: 1px dashed #ced4da;
            border-radius: 12px;
            padding: 24px;
            color: #6c757d;
        }

        .aparat-item.d-none {
            display: none !important;
        }
    </style>
@endpush

@section('content')

    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Aparat Desa & Kepala Dusun</h1>
                        <p class="mb-0">
                            Daftar perangkat Desa Ulukalo beserta Kepala Dusun. Gunakan kolom cari
                            untuk menemukan profil yang diinginkan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="current">Pemerintahan</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="aparat" class="section">
        <div class="container">

            <div class="filter-wrap row g-3 align-items-center mb-4">
                <div class="col-md-9">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input id="searchInput" type="text" class="form-control" placeholder="Cari nama atau jabatan…">
                    </div>
                </div>
                <div class="col-md-3 text-md-end">
                    <a href="{{ route('struktur') }}" class="btn btn-outline-dark">
                        <i class="bi bi-diagram-3 me-1"></i> Lihat Struktur Desa
                    </a>
                </div>
            </div>

            <div id="aparatGrid" class="row g-4">
                @foreach ($aparatDesas as $aparat)
                    <div class="col-12 col-sm-6 col-lg-4 aparat-item" data-nama="{{ strtolower($aparat->nama) }}"
                        data-jabatan="{{ strtolower($aparat->jabatan) }}">
                        <div class="card aparat-card h-100 border-0 shadow-sm">
                            <img src="{{ $aparat->foto_url }}" class="card-img-top" alt="Foto {{ $aparat->nama }}"
                                loading="lazy"
                                onerror="this.onerror=null;this.src='{{ asset('assets/img/aparat/placeholder.jpg') }}';">
                            <div class="card-body">
                                <h5 class="card-title mb-1">{{ $aparat->nama }}</h5>
                                <div class="jabatan">{{ $aparat->jabatan }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="emptyState" class="empty-state text-center mt-4 d-none">
                <i class="bi bi-search fs-3 d-block mb-2"></i>
                <div>Tidak ada data yang cocok dengan pencarian Anda.</div>
            </div>

        </div>
    </section>

@endsection

{{-- JavaScript untuk frontend search --}}
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const aparatItems = document.querySelectorAll('.aparat-item');
            const emptyState = document.getElementById('emptyState');

            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                aparatItems.forEach(function(item) {
                    const nama = item.dataset.nama;
                    const jabatan = item.dataset.jabatan;

                    const isMatch = nama.includes(searchTerm) || jabatan.includes(searchTerm);

                    if (isMatch) {
                        item.classList.remove('d-none');
                        visibleCount++;
                    } else {
                        item.classList.add('d-none');
                    }
                });

                // Show/hide empty state
                if (visibleCount === 0 && searchTerm !== '') {
                    emptyState.classList.remove('d-none');
                } else {
                    emptyState.classList.add('d-none');
                }
            }

            // Search on input
            searchInput.addEventListener('input', performSearch);

            // Clear search when input is empty
            searchInput.addEventListener('keyup', function(e) {
                if (e.target.value === '') {
                    aparatItems.forEach(function(item) {
                        item.classList.remove('d-none');
                    });
                    emptyState.classList.add('d-none');
                }
            });
        });
    </script>
@endpush
