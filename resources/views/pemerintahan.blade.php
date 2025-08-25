@extends('layouts.app')

@section('title', 'Pemerintahan – Aparat Desa & Kepala Dusun | Desa Ulukalo')

{{-- Menyisipkan CSS khusus untuk halaman ini ke dalam <head> layout --}}
@push('styles')
<style>
    /* Sentuhan kecil biar kartu rapi */
    .aparat-card img { aspect-ratio: 4/3; object-fit: cover; }
    .aparat-card .jabatan { font-size: .925rem; color: #6c757d; }
    .aparat-card .dusun { font-size: .85rem; color: #6c757d; }
    .filter-wrap .form-control, .filter-wrap .form-select { height: 48px; }
    .empty-state { border: 1px dashed #ced4da; border-radius: 12px; padding: 24px; color:#6c757d; }
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
                Daftar perangkat Desa Ulukalo beserta Kepala Dusun. Gunakan kolom cari atau filter dusun
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
    </div><section id="aparat" class="section">
      <div class="container">

        <div class="filter-wrap row g-3 align-items-center mb-4">
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
              <input id="q" type="text" class="form-control" placeholder="Cari nama atau jabatan…">
            </div>
          </div>
          <div class="col-md-3">
            <select id="dusunSelect" class="form-select">
              <option value="">Semua Dusun</option>
              </select>
          </div>
          <div class="col-md-3 text-md-end">
            <a href="{{ route('struktur') }}" class="btn btn-outline-dark"><i class="bi bi-diagram-3 me-1"></i> Lihat Struktur Desa</a>
          </div>
        </div>

        <div id="aparatGrid" class="row g-4">
          </div>

        <div id="emptyState" class="empty-state text-center mt-4 d-none">
          <i class="bi bi-search fs-3 d-block mb-2"></i>
          <div>Tidak ada data yang cocok. Coba ubah kata kunci atau filter dusun.</div>
        </div>

      </div>
    </section>@endsection

{{-- Menyisipkan JavaScript khusus untuk halaman ini sebelum penutup </body> --}}
@push('scripts')
<script>
    const GRID = document.getElementById('aparatGrid');
    const Q = document.getElementById('q');
    const DUSUN = document.getElementById('dusunSelect');
    const EMPTY = document.getElementById('emptyState');

    let DATA = [];

    function norm(s) { return (s || '').toString().toLowerCase(); }

    function uniqueDusun(list) {
      const set = new Set();
      list.forEach(x => { if (x.dusun && x.dusun.trim() !== '') set.add(x.dusun); });
      return Array.from(set).sort((a,b) => a.localeCompare(b));
    }

    function cardTemplate(item) {
      // Menggunakan helper asset() untuk path gambar placeholder yang dinamis
      const placeholderImg = `{{ asset('assets/img/aparat/placeholder.jpg') }}`;
      const foto = item.foto || placeholderImg;
      const alt = `Foto ${item.nama || 'Aparat Desa'}`;
      
      return `
        <div class="col-12 col-sm-6 col-lg-4">
          <div class="card aparat-card h-100 border-0 shadow-sm">
            <img src="${foto}" alt="${alt}" class="card-img-top" loading="lazy"
                 onerror="this.onerror=null;this.src='${placeholderImg}';">
            <div class="card-body">
              <h5 class="card-title mb-1">${item.nama || '-'}</h5>
              <div class="jabatan">${item.jabatan || '-'}</div>
              <div class="dusun">${item.dusun || '-'}</div>
            </div>
          </div>
        </div>`;
    }

    function render() {
      const q = norm(Q.value);
      const fDusun = DUSUN.value;

      const filtered = DATA.filter(x => {
        const hitQ = !q || norm(x.nama).includes(q) || norm(x.jabatan).includes(q);
        const hitD = !fDusun || (x.dusun === fDusun);
        return hitQ && hitD;
      });

      GRID.innerHTML = filtered.map(cardTemplate).join('');
      EMPTY.classList.toggle('d-none', filtered.length > 0);
    }

    // Init: Menggunakan helper asset() untuk path file JSON yang dinamis
    fetch(`{{ asset('assets/js/aparat.json') }}`)
      .then(r => r.json())
      .then(json => {
        DATA = Array.isArray(json) ? json : [];
        const dusunList = uniqueDusun(DATA);
        DUSUN.innerHTML = '<option value="">Semua Dusun</option>' + dusunList.map(d => `<option value="${d}">${d}</option>`).join('');
        render();
      })
      .catch((err) => {
        console.error("Gagal memuat data aparat:", err);
        DATA = [];
        render();
      });

    Q.addEventListener('input', render);
    DUSUN.addEventListener('change', render);
</script>
@endpush