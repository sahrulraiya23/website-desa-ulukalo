@extends('layouts.app')

@section('title', 'Layanan Surat – Desa Ulukalo')

@push('styles')
    <style>
        .surat-card {
            border: 1px solid #e9ecef;
            border-radius: 14px;
            height: 100%;
            transition: .2s
        }

        .surat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 26px rgba(0, 0, 0, .08)
        }

        .tpl-frame {
            width: 100%;
            min-height: 520px;
            border: 1px solid #e9ecef;
            border-radius: 14px
        }

        .sticky-md {
            position: sticky;
            top: 90px
        }

        .req::after {
            content: " *";
            color: #dc3545
        }

        .result-wrap {
            border: 1px solid #e9ecef;
            border-radius: 14px;
            padding: 28px;
            background: #fff
        }

        .kop-desa {
            text-align: center;
            border-bottom: 2px solid #000;
            margin-bottom: 12px;
            padding-bottom: 10px
        }

        .kop-desa .title {
            font-weight: 800;
            font-size: 20px;
            letter-spacing: .5px
        }

        .kop-desa .sub {
            font-weight: 700
        }

        .kop-desa .addr {
            font-size: 12px
        }

        .judul-surat {
            text-align: center;
            font-weight: 700;
            text-decoration: underline;
            margin: 12px 0 0
        }

        .nomor-surat {
            text-align: center;
            margin-top: 2px
        }

        .ttd {
            width: 260px;
            float: right;
            margin-top: 28px
        }

        .ttd .nm {
            margin-top: 68px;
            font-weight: 700;
            text-decoration: underline
        }

        .ttd .nip {
            margin-top: -6px
        }

        .form-floating>.form-control,
        .form-select {
            height: 52px
        }

        @media print {
            body {
                background: #fff
            }

            .no-print {
                display: none !important
            }

            @page {
                size: A4;
                margin: 20mm
            }

            .result-wrap {
                border: none;
                padding: 0
            }
        }
    </style>
@endpush


@section('content')

    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-9">
                        <h1 class="heading-title">Layanan Surat Desa</h1>
                        <p class="mb-0">Pilih jenis surat untuk melihat <b>format</b>, lalu klik <b>Buat Surat</b> untuk
                            isi biodata dan unduh hasilnya.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="current">Layanan Surat</li>
                </ol>
            </div>
        </nav>
    </div>

    <section class="section pt-0">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div id="pilihanSurat" class="row g-3"></div>
                </div>

                <div class="col-lg-7">
                    <div class="sticky-md">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h3 class="h6 mb-0">Pratinjau Format</h3>
                            <div class="text-muted small" id="tplFilename"></div>
                        </div>
                        <div id="tplWrap">
                            <iframe id="tplFrame" class="tpl-frame" title="Pratinjau Template" src=""></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="p-3 p-lg-4 border rounded-3">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                    <h3 class="h5 mb-0">Form Pengisian</h3>
                    <div class="d-flex gap-2">
                        <select id="jenisSelect" class="form-select"></select>
                        <button id="btnIsiCepat" class="btn btn-outline-secondary" type="button"
                            title="Contoh pengisian">Isi contoh</button>
                    </div>
                </div>
                <form id="formSurat" class="row g-3"></form>
                <div class="d-flex gap-2 mt-3">
                    <button id="btnLihatHasil" class="btn btn-dark" type="button"><i class="bi bi-eye me-1"></i>Lihat
                        Hasil</button>
                    <button id="btnReset" class="btn btn-outline-secondary" type="button">Reset</button>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h3 class="h5 mb-0">Hasil Surat</h3>
                <div class="no-print d-flex gap-2">
                    <button id="btnUnduh" class="btn btn-dark" type="button"><i class="bi bi-filetype-pdf me-1"></i>Unduh
                        PDF</button>
                    <button id="btnCetak" class="btn btn-outline-dark" type="button"><i
                            class="bi bi-printer me-1"></i>Cetak</button>
                </div>
            </div>
            <div id="hasilSurat" class="result-wrap">
                <div class="text-muted">Hasil akan muncul di sini setelah Anda klik <b>Lihat Hasil</b>.</div>
            </div>
        </div>
    </section>

@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        referrerpolicy="no-referrer"></script>

    <script>
        // Konfigurasi diambil dari data yang dikirim oleh Controller
        let CFG = {!! $suratConfigJson !!};

        // (Seluruh kode JavaScript dari file HTML Anda sebelumnya, ditempel di sini)
        // ===== Util =====
        const $ = s => document.querySelector(s);
        const el = id => document.getElementById(id);
        const toTitle = s => (s || '').replace(/-/g, ' ').replace(/\b\w/g, m => m.toUpperCase());

        // ===== State =====
        let current = "sku";

        // ===== Init UI =====
        function init() {
            // (Pastikan CFG.jenis ada untuk menghindari error)
            if (!CFG.jenis) CFG.jenis = {};

            const list = document.createElement('div');
            list.className = 'row g-3';
            const select = el('jenisSelect');
            select.innerHTML = '';
            Object.entries(CFG.jenis).forEach(([key, obj]) => {
                const opt = document.createElement('option');
                opt.value = key;
                opt.textContent = obj.nama;
                select.appendChild(opt);
                const col = document.createElement('div');
                col.className = 'col-12';
                // Path template PDF sekarang dinamis menggunakan asset()
                obj.template = obj.template ? `{{ asset('') }}${obj.template}` : '';
                col.innerHTML = `
                <div class="surat-card p-3">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div>
                        <div class="fw-semibold">${obj.nama}</div>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-dark btn-sm" data-act="preview" data-key="${key}"><i class="bi bi-eye me-1"></i>Lihat Format</button>
                        <button class="btn btn-dark btn-sm" data-act="buat" data-key="${key}"><i class="bi bi-pencil-square me-1"></i>Buat Surat</button>
                    </div>
                    </div>
                </div>`;
                list.appendChild(col);
            });
            el('pilihanSurat').innerHTML = '';
            el('pilihanSurat').appendChild(list);
            list.addEventListener('click', (e) => {
                const btn = e.target.closest('button[data-act]');
                if (!btn) return;
                const key = btn.dataset.key;
                if (btn.dataset.act === 'preview') {
                    setCurrent(key, true);
                }
                if (btn.dataset.act === 'buat') {
                    setCurrent(key, true);
                    el('formSurat').scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
            select.addEventListener('change', e => setCurrent(e.target.value, false));
            el('btnIsiCepat').addEventListener('click', isiContoh);
            el('btnLihatHasil').addEventListener('click', renderHasil);
            el('btnReset').addEventListener('click', () => {
                el('formSurat').reset();
            });
            el('btnCetak').addEventListener('click', () => window.print());
            el('btnUnduh').addEventListener('click', unduhPDF);
            const first = Object.keys(CFG.jenis)[0] || "sku";
            setCurrent(first, true);
        }

        // ... (Sisa kode JavaScript dari file HTML Anda ditempel di sini, dari function setCurrent sampai akhir)
        function setCurrent(key, updatePreview = true) {
            current = key;
            el('jenisSelect').value = key;
            if (updatePreview) {
                const tpl = (CFG.jenis[key] || {}).template || '';
                el('tplFrame').src = tpl ? (tpl + '#toolbar=0') : '';
                el('tplFilename').textContent = (CFG.jenis[key] || {}).template || '—';
            }
            buildForm(key);
        }

        function buildForm(key) {
            const meta = CFG.jenis[key];
            if (!meta) {
                el('formSurat').innerHTML = '';
                return;
            }
            const rows = meta.fields.map(f => {
                const id = 'f_' + f.name;
                const label =
                    `<label for="${id}" class="form-label ${f.req?'req':''}">${f.label||toTitle(f.name)}</label>`;
                if (f.type === 'textarea') {
                    return `<div class="col-12"><div class="mb-1">${label}<textarea id="${id}" name="${f.name}" class="form-control" rows="3" ${f.req?'required':''} placeholder="${f.placeholder||''}"></textarea></div></div>`;
                }
                if (f.type === 'select') {
                    const opts = (f.options || []).map(o => `<option value="${o}">${o}</option>`).join('');
                    return `<div class="col-md-6"><div class="mb-1">${label}<select id="${id}" name="${f.name}" class="form-select" ${f.req?'required':''}>${opts}</select></div></div>`;
                }
                return `<div class="col-md-6"><div class="mb-1">${label}<input id="${id}" name="${f.name}" type="${f.type||'text'}" class="form-control" ${f.req?'required':''} placeholder="${f.placeholder||''}"></div></div>`;
            }).join('');
            el('formSurat').innerHTML = rows;
        }

        function isiContoh() {
            const form = el('formSurat');
            const fill = (n, v) => {
                const x = form.querySelector(`[name="${n}"]`);
                if (x) x.value = v;
            };
            const today = new Date().toISOString().slice(0, 10);
            if (current === 'sku') {
                fill('nomor', '470/123/DU/2025');
                fill('nama', 'Rahman');
                fill('ttl', 'Kolaka, 12 Januari 1998');
                fill('alamat', 'Dusun I, Desa Ulukalo, Kec. Iwoimendaa, Kab. Kolaka');
                fill('dusun', 'I');
                fill('nik', '7402XXXXXXXXXXXX');
                fill('domisili', '2017');
                fill('sektor_perdagangan', 'Perdagangan eceran (warung sembako)');
                fill('tanggal', today);
            } else if (current === 'sktm') {
                fill('nomor', '400/045/DU/2025');
                fill('nama', 'Siti Aminah');
                fill('jk', 'Perempuan');
                fill('ttl', 'Kolaka, 3 Maret 2005');
                fill('pekerjaan', 'Pelajar');
                fill('alamat', 'Dusun II, Desa Ulukalo');
                fill('tanggal', today);
            } else if (current === 'skbb') {
                fill('nomor', '331/210/DU/2025');
                fill('pen_nama', 'NAMA KEPALA DESA');
                fill('pen_umur', '45');
                fill('pen_jabatan', 'Kepala Desa Ulukalo');
                fill('nama', 'Ardiansyah');
                fill('ttl', 'Kolaka, 21 Juli 2000');
                fill('nik', '7402XXXXXXXXXXXX');
                fill('jk', 'Laki-laki');
                fill('alamat', 'Dusun III, Desa Ulukalo');
                fill('maksud', 'Melamar pekerjaan');
                fill('camat_nama', 'NAMA CAMAT');
                fill('camat_nip', 'NIP. 123456789');
                fill('tanggal', today);
            } else if (current === 'skbm') {
                fill('nomor', '474/078/DU/2025');
                fill('nama', 'Nur Aini');
                fill('ttl', 'Kolaka, 8 Agustus 2002');
                fill('jk', 'Perempuan');
                fill('pekerjaan', 'Mahasiswa');
                fill('agama', 'Islam');
                fill('alamat', 'Dusun I, Desa Ulukalo');
                fill('tanggal', today);
            } else if (current === 'sptjm') {
                fill('nomor', '470/999/DU/2025');
                fill('pen_nama', 'NAMA KEPALA DESA');
                fill('pen_jabatan', 'Kepala Desa Ulukalo');
                fill('pen_alamat', 'Kantor Desa Ulukalo, Kolaka');
                fill('subjek_nama', 'Rahman');
                fill('subjek_nik', '7402XXXXXXXXXXXX');
                fill('subjek_nokk', '7402XXXXXXXXXXXX');
                fill('tanggal', today);
            }
        }

        function formDataObj() {
            const fd = new FormData(el('formSurat'));
            const data = {};
            for (const [k, v] of fd.entries()) {
                data[k] = v;
            }
            return data;
        }

        function renderHasil() {
            const form = el('formSurat');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            const meta = CFG.jenis[current],
                P = CFG.profilDesa,
                K = CFG.kepalaDesa;
            const Camat = CFG.camat || {};
            const d = formDataObj();
            const kop =
                `<div class="kop-desa"><div class="sub">PEMERINTAH ${P.kabupaten||'KABUPATEN …'}</div><div class="sub">${P.kecamatan||'KECAMATAN …'}</div><div class="title">${P.desa||'DESA …'}</div><div class="addr">${P.alamatKantor||'Alamat Kantor …'}</div></div>`;
            let body = '';
            if (current === 'sku') {
                body =
                    `<div class="judul-surat">SURAT KETERANGAN USAHA</div><div class="nomor-surat">Nomor: ${d.nomor||'-'}</div><p>Yang bertanda tangan di bawah ini, Kepala ${P.desa||'Desa'}, menerangkan bahwa:</p><table style="width:100%;margin-left:6px"><tr><td style="width:190px">Nama</td><td>: ${d.nama||'-'}</td></tr><tr><td>Tempat/Tgl Lahir</td><td>: ${d.ttl||'-'}</td></tr><tr><td>Alamat</td><td>: ${d.alamat||'-'}</td></tr><tr><td>Dusun</td><td>: ${d.dusun||'-'}</td></tr><tr><td>Nomor KTP</td><td>: ${d.nik||'-'}</td></tr><tr><td>Domisili Sejak Tahun</td><td>: ${d.domisili||'-'}</td></tr></table><p>Benar yang bersangkutan memiliki/mengelola usaha pada sektor:</p><ul style="margin-top:-6px">${d.sektor_pertanian?`<li>Pertanian: ${d.sektor_pertanian}</li>`:''}${d.sektor_industri?`<li>Industri: ${d.sektor_industri}</li>`:''}${d.sektor_perdagangan?`<li>Perdagangan: ${d.sektor_perdagangan}</li>`:''}${d.sektor_jasa?`<li>Jasa & Dunia Usaha: ${d.sektor_jasa}</li>`:''}</ul><p>Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</p>${ttdBlock(d.tanggal, P.desa, K)}`;
            } else if (current === 'sktm') {
                body =
                    `<div class="judul-surat">SURAT KETERANGAN TIDAK MAMPU</div><div class="nomor-surat">Nomor: ${d.nomor||'-'}</div><p>Yang bertanda tangan di bawah ini, Kepala ${P.desa||'Desa'}, menerangkan bahwa:</p><table style="width:100%;margin-left:6px"><tr><td style="width:190px">Nama</td><td>: ${d.nama||'-'}</td></tr><tr><td>Jenis Kelamin</td><td>: ${d.jk||'-'}</td></tr><tr><td>Tempat/Tgl Lahir</td><td>: ${d.ttl||'-'}</td></tr><tr><td>Pekerjaan</td><td>: ${d.pekerjaan||'-'}</td></tr><tr><td>Alamat</td><td>: ${d.alamat||'-'}</td></tr></table><p>Berdasarkan keterangan RT/RW setempat, yang bersangkutan benar berasal dari keluarga yang <b>tidak mampu</b>.</p><p>Demikian surat keterangan ini dibuat agar dapat dipergunakan sebagaimana mestinya.</p>${ttdBlock(d.tanggal, P.desa, K)}`;
            } else if (current === 'skbb') {
                body =
                    `<div class="judul-surat">SURAT KETERANGAN BERKELAKUAN BAIK</div><div class="nomor-surat">Nomor: ${d.nomor||'-'}</div><p>Yang bertanda tangan di bawah ini:</p><table style="width:100%;margin-left:6px"><tr><td style="width:190px">Nama</td><td>: ${d.pen_nama||'-'}</td></tr>${d.pen_umur?`<tr><td>Umur</td><td>: ${d.pen_umur}</td></tr>`:''}<tr><td>Pekerjaan/Jabatan</td><td>: ${d.pen_jabatan||'-'}</td></tr></table><p>Dengan ini menerangkan bahwa:</p><table style="width:100%;margin-left:6px"><tr><td style="width:190px">Nama</td><td>: ${d.nama||'-'}</td></tr><tr><td>Tempat/Tgl Lahir</td><td>: ${d.ttl||'-'}</td></tr><tr><td>NIK</td><td>: ${d.nik||'-'}</td></tr><tr><td>Jenis Kelamin</td><td>: ${d.jk||'-'}</td></tr><tr><td>Alamat</td><td>: ${d.alamat||'-'}</td></tr></table><p>Sepanjang pengetahuan kami, yang bersangkutan <b>berkelakuan baik</b> dan tidak pernah terlibat tindak pidana. Surat keterangan ini dibuat untuk keperluan: <b>${d.maksud||'-'}</b>.</p>${ttdBlock(d.tanggal, P.desa, K)}<div style="clear:both"></div><div style="margin-top:40px"><div>Mengetahui,</div><div>Camat ${P.kecamatan?.replace(/^KECAMATAN\s+/,'')||'...'}</div><div style="margin-top:68px;text-decoration:underline;font-weight:700">${d.camat_nama||Camat.nama||'[Nama Camat]'}</div><div>${d.camat_nip||Camat.nip||'NIP. -'}</div></div>`;
            } else if (current === 'skbm') {
                body =
                    `<div class="judul-surat">SURAT KETERANGAN BELUM MENIKAH</div><div class="nomor-surat">Nomor: ${d.nomor||'-'}</div><p>Yang bertanda tangan di bawah ini, Kepala ${P.desa||'Desa'}, menerangkan bahwa:</p><table style="width:100%;margin-left:6px"><tr><td style="width:190px">Nama</td><td>: ${d.nama||'-'}</td></tr><tr><td>Tempat/Tgl Lahir</td><td>: ${d.ttl||'-'}</td></tr><tr><td>Jenis Kelamin</td><td>: ${d.jk||'-'}</td></tr><tr><td>Pekerjaan</td><td>: ${d.pekerjaan||'-'}</td></tr><tr><td>Agama</td><td>: ${d.agama||'-'}</td></tr><tr><td>Alamat</td><td>: ${d.alamat||'-'}</td></tr></table><p>Hingga surat ini dikeluarkan, yang bersangkutan tercatat <b>belum menikah</b>.</p><p>Demikian surat keterangan ini dibuat agar dipergunakan sebagaimana mestinya.</p>${ttdBlock(d.tanggal, P.desa, K)}`;
            } else if (current === 'sptjm') {
                body =
                    `<div class="judul-surat">SURAT PERNYATAAN TANGGUNG JAWAB MUTLAK</div><div class="nomor-surat">Nomor: ${d.nomor||'-'}</div><p>Saya yang bertanda tangan di bawah ini:</p><table style="width:100%;margin-left:6px"><tr><td style="width:190px">Nama</td><td>: ${d.pen_nama||'-'}</td></tr><tr><td>Jabatan</td><td>: ${d.pen_jabatan||'-'}</td></tr><tr><td>Alamat</td><td>: ${d.pen_alamat||'-'}</td></tr></table><p>Dengan ini menyatakan bertanggung jawab penuh atas keabsahan data berikut:</p><table style="width:100%;margin-left:6px"><tr><td style="width:190px">Nama Penduduk</td><td>: ${d.subjek_nama||'-'}</td></tr><tr><td>NIK</td><td>: ${d.subjek_nik||'-'}</td></tr><tr><td>No. KK</td><td>: ${d.subjek_nokk||'-'}</td></tr></table><p>Apabila di kemudian hari terdapat ketidaksesuaian, saya bersedia menanggung segala akibat hukum yang timbul.</p>${ttdBlock(d.tanggal, P.desa, K)}`;
            }
            el('hasilSurat').innerHTML = kop + body;
        }

        function ttdBlock(tanggal, desa, K) {
            const tgl = tanggal ? formatTanggalID(tanggal) : new Date().toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            return `<div class="ttd"><div>${desa||'Desa …'}, ${tgl}</div><div>KEPALA DESA</div><div class="nm">${K.nama||'[Nama Kepala Desa]'}</div><div class="nip">${K.nip||'NIP. -'}</div></div><div style="clear:both"></div>`;
        }

        function formatTanggalID(iso) {
            try {
                const d = new Date(iso);
                return d.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
            } catch (e) {
                return iso;
            }
        }

        function unduhPDF() {
            const jenis = (CFG.jenis[current] || {}).nama || toTitle(current);
            const d = formDataObj();
            const nama = ((d.nama || d.subjek_nama || 'warga') + '').toLowerCase().trim().replace(/\s+/g, '-').replace(
                /[^a-z0-9-]/g, '');
            const nom = (d.nomor || '').replace(/[^\d]/g, '');
            const fname = `${jenis.replace(/\s+/g,'-').toLowerCase()}-${nama}${nom?('-'+nom):''}.pdf`;
            const area = el('hasilSurat');
            if (!area || area.textContent.trim().startsWith('Hasil akan')) {
                alert('Silakan klik "Lihat Hasil" dulu.');
                return;
            }
            const opt = {
                margin: 20,
                filename: fname,
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };
            html2pdf().from(area).set(opt).save();
        }

        // Panggil init setelah DOM siap
        document.addEventListener('DOMContentLoaded', init);
    </script>
@endpush
