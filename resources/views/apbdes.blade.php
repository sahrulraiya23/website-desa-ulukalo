@extends('layouts.app')

@section('title', 'APBDes – Desa Ulukalo')

{{-- Menyisipkan CSS khusus untuk halaman ini --}}
@push('styles')
    <style>
        .apb-cards .card {
            border: 0;
            border-radius: 14px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .06);
        }

        .apb-cards .label {
            color: #6c757d;
            font-size: .9rem;
        }

        .apb-cards .value {
            font-weight: 700;
            font-size: 1.25rem;
        }

        .apb-section {
            border-radius: 14px;
        }

        .doc-card {
            border: 1px solid #e9ecef;
            border-radius: 14px;
            transition: .2s;
        }

        .doc-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 24px rgba(0, 0, 0, .08);
        }

        .table thead th {
            background: #f8f9fa;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .year-select {
            height: 48px;
        }

        .apb-legend small {
            color: #6c757d
        }

        .infografis {
            border-radius: 14px;
            border: 1px solid #e9ecef;
        }
    </style>
@endpush


@section('content')

    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">APBDes Desa Ulukalo</h1>
                        <p class="mb-0">Ringkasan Anggaran Pendapatan dan Belanja Desa beserta dokumen resmi per tahun
                            anggaran.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="current">APBDes</li>
                </ol>
            </div>
        </nav>
    </div>
    <section class="section">
        <div class="container">
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-4">
                    <label class="form-label mb-1">Tahun Anggaran</label>
                    <select id="tahunSelect" class="form-select year-select"></select>
                </div>
                <div class="col-md-8">
                    <div class="d-flex flex-wrap gap-2 mt-3 mt-md-0">
                        <a id="btnAPB" class="btn btn-dark disabled" target="_blank" rel="noopener">
                            <i class="bi bi-file-earmark-pdf me-1"></i> Unduh Dokumen APBDes
                        </a>
                        <a id="btnPerdes" class="btn btn-outline-dark disabled" target="_blank" rel="noopener">
                            <i class="bi bi-file-text me-1"></i> Perdes APBDes
                        </a>
                        <a id="btnLRA" class="btn btn-outline-dark disabled" target="_blank" rel="noopener">
                            <i class="bi bi-journal-check me-1"></i> Laporan Realisasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section pt-0">
        <div class="container">
            <div class="row g-3 apb-cards">
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="label">Pendapatan</div>
                        <div id="vPendapatan" class="value">Rp -</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="label">Belanja</div>
                        <div id="vBelanja" class="value">Rp -</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="label">Pembiayaan (Netto)</div>
                        <div id="vPembiayaan" class="value">Rp -</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3">
                        <div class="label">SILPA/Defisit</div>
                        <div id="vSilpa" class="value">Rp -</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section pt-0">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="p-3 p-lg-4 border apb-section">
                        <h3 class="h5 mb-3">Rincian Pendapatan</h3>
                        <div class="table-responsive" style="max-height:420px;">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th style="width:60%">Uraian</th>
                                        <th class="text-end">Anggaran</th>
                                    </tr>
                                </thead>
                                <tbody id="tPendapatan"></tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total Pendapatan</th>
                                        <th id="tPendapatanTotal" class="text-end">Rp -</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="p-3 p-lg-4 border apb-section">
                        <h3 class="h5 mb-3">Rincian Belanja</h3>
                        <div class="table-responsive" style="max-height:420px;">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th style="width:60%">Bidang/Kegiatan</th>
                                        <th class="text-end">Anggaran</th>
                                    </tr>
                                </thead>
                                <tbody id="tBelanja"></tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total Belanja</th>
                                        <th id="tBelanjaTotal" class="text-end">Rp -</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section pt-0">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="p-3 p-lg-4 border apb-section h-100">
                        <h3 class="h5 mb-3">Pratinjau Infografis</h3>
                        <a id="imgLink" target="_blank" rel="noopener">
                            <img id="imgInfo" class="img-fluid infografis"
                                src="{{ asset('assets/img/apbdes/placeholder.png') }}" alt="Infografis APBDes">
                        </a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="p-3 p-lg-4 border apb-section h-100">
                        <h3 class="h5 mb-3">Dokumen Terkait</h3>
                        <div class="row g-3">
                            <div class="col-12">
                                <a id="btnInfografis"
                                    class="doc-card d-flex align-items-center p-3 text-decoration-none disabled"
                                    target="_blank" rel="noopener">
                                    <i class="bi bi-image fs-4 me-3"></i>
                                    <div>
                                        <div class="fw-semibold">Lihat Infografis</div>
                                        <small class="text-muted">Gambar</small>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12">
                                <a id="btnRealisasi1"
                                    class="doc-card d-flex align-items-center p-3 text-decoration-none disabled"
                                    target="_blank" rel="noopener">
                                    <i class="bi bi-file-earmark-bar-graph fs-4 me-3"></i>
                                    <div>
                                        <div class="fw-semibold">Realisasi Semester I</div>
                                        <small class="text-muted">PDF</small>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12">
                                <a id="btnRealisasi2"
                                    class="doc-card d-flex align-items-center p-3 text-decoration-none disabled"
                                    target="_blank" rel="noopener">
                                    <i class="bi bi-file-earmark-bar-graph fs-4 me-3"></i>
                                    <div>
                                        <div class="fw-semibold">Realisasi Akhir Tahun</div>
                                        <small class="text-muted">PDF</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

{{-- Menyisipkan JavaScript khusus untuk halaman ini --}}
@push('scripts')
    <script>
        const fmt = n => new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0
        }).format(n || 0);

        const els = {
            tahun: document.getElementById('tahunSelect'),
            vPendapatan: document.getElementById('vPendapatan'),
            vBelanja: document.getElementById('vBelanja'),
            vPembiayaan: document.getElementById('vPembiayaan'),
            vSilpa: document.getElementById('vSilpa'),
            tPendapatan: document.getElementById('tPendapatan'),
            tBelanja: document.getElementById('tBelanja'),
            tPendapatanTotal: document.getElementById('tPendapatanTotal'),
            tBelanjaTotal: document.getElementById('tBelanjaTotal'),
            btnAPB: document.getElementById('btnAPB'),
            btnPerdes: document.getElementById('btnPerdes'),
            btnLRA: document.getElementById('btnLRA'),
            btnRealisasi1: document.getElementById('btnRealisasi1'),
            btnRealisasi2: document.getElementById('btnRealisasi2'),
            btnInfografis: document.getElementById('btnInfografis'),
            imgInfo: document.getElementById('imgInfo'),
            imgLink: document.getElementById('imgLink'),
        };

        let DB = {};

        function sum(obj) {
            return Object.values(obj || {}).reduce((a, b) => a + (+b || 0), 0);
        }

        function setHref(a, href) {
            if (href) {
                a.href = href;
                a.classList.remove('disabled');
                a.setAttribute('aria-disabled', 'false');
            } else {
                a.href = '#';
                a.classList.add('disabled');
                a.setAttribute('aria-disabled', 'true');
            }
        }

        function renderYear(y) {
            const d = DB[y] || {};
            const pend = d.pendapatan || {};
            const bel = d.belanja || {};
            const pbi = d.pembiayaan || {
                "Penerimaan": 0,
                "Pengeluaran": 0
            };

            // cards
            const totalPend = sum(pend);
            const totalBel = sum(bel);
            const netto = (+pbi["Penerimaan"] || 0) - (+pbi["Pengeluaran"] || 0);
            const silpa = totalPend + (+pbi["Penerimaan"] || 0) - (+pbi["Pengeluaran"] || 0) - totalBel;

            els.vPendapatan.textContent = fmt(totalPend);
            els.vBelanja.textContent = fmt(totalBel);
            els.vPembiayaan.textContent = fmt(netto);
            els.vSilpa.textContent = fmt(silpa);

            // tables
            const trp = Object.entries(pend).map(([k, v]) => `<tr><td>${k}</td><td class="text-end">${fmt(v)}</td></tr>`)
                .join('') || `<tr><td colspan="2" class="text-center text-muted">Belum ada data</td></tr>`;
            const trb = Object.entries(bel).map(([k, v]) => `<tr><td>${k}</td><td class="text-end">${fmt(v)}</td></tr>`)
                .join('') || `<tr><td colspan="2" class="text-center text-muted">Belum ada data</td></tr>`;
            els.tPendapatan.innerHTML = trp;
            els.tBelanja.innerHTML = trb;
            els.tPendapatanTotal.textContent = fmt(totalPend);
            els.tBelanjaTotal.textContent = fmt(totalBel);

            // docs
            const doc = d.dokumen || {};
            setHref(els.btnAPB, doc.apbdes);
            setHref(els.btnPerdes, doc.perdes);
            setHref(els.btnLRA, doc.laporan || doc['lra']);
            setHref(els.btnRealisasi1, doc['realisasi-sem1']);
            setHref(els.btnRealisasi2, doc['realisasi-sem2']);
            setHref(els.btnInfografis, doc.infografis);

            if (doc.infografis) {
                els.imgInfo.src = doc.infografis;
                els.imgLink.href = doc.infografis;
            } else {
                // Menggunakan helper asset() untuk path gambar placeholder
                els.imgInfo.src = `{{ asset('assets/img/apbdes/placeholder.png') }}`;
                els.imgLink.href = '#';
            }
        }

        function initYears() {
            const years = Object.keys(DB).sort((a, b) => (+b) - (+a));
            if (years.length === 0) {
                // Jika JSON kosong, buat data dummy untuk tahun ini
                const now = new Date().getFullYear();
                DB[now] = {
                    pendapatan: {},
                    belanja: {},
                    pembiayaan: {},
                    dokumen: {}
                };
                // Menambahkan path dinamis ke dokumen dummy
                const docs = DB[now].dokumen;
                docs.apbdes = `{{ asset('assets/docs/apbdes-') }}${now}.pdf`;
                docs.perdes = `{{ asset('assets/docs/perdes-apbdes-') }}${now}.pdf`;
                docs['realisasi-sem1'] = `{{ asset('assets/docs/realisasi-sem1-') }}${now}.pdf`;
                docs['realisasi-sem2'] = `{{ asset('assets/docs/realisasi-sem2-') }}${now}.pdf`;
                docs.laporan = `{{ asset('assets/docs/lra-') }}${now}.pdf`;
                docs.infografis = `{{ asset('assets/img/apbdes/infografis-') }}${now}.png`;
                years.push(now.toString());
            }

            els.tahun.innerHTML = years.map(y => `<option value="${y}">${y}</option>`).join('');
            renderYear(years[0]);
            els.tahun.value = years[0];
            els.tahun.addEventListener('change', e => renderYear(e.target.value));
        }

        // Menggunakan helper asset() untuk path file JSON
        fetch(`{{ asset('assets/js/apbdes.json') }}`)
            .then(r => r.ok ? r.json() : Promise.reject())
            .then(json => {
                DB = json || {};
                initYears();
            })
            .catch((err) => {
                console.error("Gagal memuat apbdes.json. Menampilkan data dummy.", err);
                DB = {};
                initYears();
            });
    </script>
@endpush
