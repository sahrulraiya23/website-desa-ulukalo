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
        }

        .ttd-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 28px;
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

        .loading {
            display: none;
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
                    <button id="btnUnduh" class="btn btn-dark" type="button">
                        <i class="bi bi-filetype-pdf me-1"></i>
                        <span class="btn-text">Unduh PDF</span>
                        <span class="loading">
                            <i class="bi bi-arrow-clockwise spin me-1"></i>Memproses...
                        </span>
                    </button>
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
    <style>
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .spin {
            animation: spin 1s linear infinite;
        }
    </style>

    <script>
        // CSRF Token untuk Laravel
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Konfigurasi diambil dari data yang dikirim oleh Controller
        let CFG = {!! $suratConfigJson !!};

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

            // Tambahkan button alternative untuk fallback
            const btnUnduhAlt = document.createElement('button');
            btnUnduhAlt.className = 'btn btn-outline-dark';
            btnUnduhAlt.innerHTML = '<i class="bi bi-download me-1"></i>Unduh (Alt)';
            btnUnduhAlt.style.display = 'none';
            btnUnduhAlt.addEventListener('click', unduhPDFForm);
            el('btnUnduh').parentNode.insertBefore(btnUnduhAlt, el('btnUnduh').nextSibling);

            // Show alternative button if AJAX fails
            window.showAltDownload = () => {
                btnUnduhAlt.style.display = 'inline-block';
            };
            const first = Object.keys(CFG.jenis)[0] || "sku";
            setCurrent(first, true);
        }

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

        // Render hasil menggunakan AJAX ke Laravel
        async function renderHasil() {
            const form = el('formSurat');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            try {
                const formData = new FormData(form);
                formData.append('jenis', current);

                const response = await fetch('{{ route('surat.preview') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                });

                const result = await response.json();

                if (result.error) {
                    throw new Error(result.error);
                }

                el('hasilSurat').innerHTML = result.html;
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan: ' + error.message);
            }
        }

        // Download PDF menggunakan Laravel DomPDF
        async function unduhPDF() {
            const form = el('formSurat');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const area = el('hasilSurat');
            if (!area || area.textContent.trim().startsWith('Hasil akan')) {
                alert('Silakan klik "Lihat Hasil" dulu.');
                return;
            }

            // Show loading state
            const btn = el('btnUnduh');
            const btnText = btn.querySelector('.btn-text');
            const loading = btn.querySelector('.loading');

            btnText.style.display = 'none';
            loading.style.display = 'inline';
            btn.disabled = true;

            try {
                const formData = new FormData(form);
                formData.append('jenis', current);

                console.log('Sending request to:', '{{ route('surat.pdf') }}');
                console.log('Form data:', Object.fromEntries(formData));

                const response = await fetch('{{ route('surat.pdf') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/pdf'
                    },
                    body: formData
                });

                console.log('Response status:', response.status);
                console.log('Response headers:', [...response.headers.entries()]);

                if (!response.ok) {
                    // Try to get error message from response
                    let errorMessage = `HTTP ${response.status}: ${response.statusText}`;
                    try {
                        const errorText = await response.text();
                        console.log('Error response:', errorText);

                        // Check if it's JSON error response
                        try {
                            const errorJson = JSON.parse(errorText);
                            if (errorJson.message) {
                                errorMessage = errorJson.message;
                            }
                        } catch (e) {
                            // If not JSON, use first 200 chars of error text
                            if (errorText.length > 0) {
                                errorMessage = errorText.substring(0, 200) + (errorText.length > 200 ? '...' : '');
                            }
                        }
                    } catch (e) {
                        console.log('Could not read error response:', e);
                    }
                    throw new Error(errorMessage);
                }

                // Check content type
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/pdf')) {
                    console.log('Unexpected content type:', contentType);
                    const text = await response.text();
                    console.log('Response body:', text);
                    throw new Error('Server tidak mengembalikan file PDF. Content-Type: ' + contentType);
                }

                // Get filename from response headers
                const contentDisposition = response.headers.get('content-disposition');
                let filename = 'surat.pdf';
                if (contentDisposition) {
                    const filenameMatch = contentDisposition.match(/filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/);
                    if (filenameMatch) {
                        filename = filenameMatch[1].replace(/['"]/g, '');
                    }
                }

                console.log('Downloading as:', filename);

                // Download file
                const blob = await response.blob();
                console.log('Blob size:', blob.size, 'bytes');

                if (blob.size === 0) {
                    throw new Error('File PDF kosong');
                }

                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);

                console.log('Download completed successfully');

            } catch (error) {
                console.error('PDF Download Error:', error);
                alert('Terjadi kesalahan saat mengunduh PDF:\n\n' + error.message +
                    '\n\nSilakan coba tombol "Unduh (Alt)" atau periksa console browser untuk detail lebih lanjut.');

                // Show alternative download button
                if (window.showAltDownload) {
                    window.showAltDownload();
                }
            } finally {
                // Reset button state
                btnText.style.display = 'inline';
                loading.style.display = 'none';
                btn.disabled = false;
            }
        }

        // Alternative download method jika AJAX tidak bekerja
        function unduhPDFForm() {
            const form = el('formSurat');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const area = el('hasilSurat');
            if (!area || area.textContent.trim().startsWith('Hasil akan')) {
                alert('Silakan klik "Lihat Hasil" dulu.');
                return;
            }

            // Buat form baru untuk submit
            const downloadForm = document.createElement('form');
            downloadForm.method = 'POST';
            downloadForm.action = '{{ route('surat.pdf') }}';
            downloadForm.style.display = 'none';

            // Add CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            downloadForm.appendChild(csrfInput);

            // Add jenis
            const jenisInput = document.createElement('input');
            jenisInput.type = 'hidden';
            jenisInput.name = 'jenis';
            jenisInput.value = current;
            downloadForm.appendChild(jenisInput);

            // Copy all form data
            const formData = new FormData(form);
            for (const [key, value] of formData.entries()) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = value;
                downloadForm.appendChild(input);
            }

            document.body.appendChild(downloadForm);
            downloadForm.submit();
            document.body.removeChild(downloadForm);
        }
        document.addEventListener('DOMContentLoaded', init);
    </script>
@endpush
