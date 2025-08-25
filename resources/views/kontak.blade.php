@extends('layouts.app')

@section('title', 'Kontak – Desa Ulukalo')

@section('content')

    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Kontak</h1>
                        <p class="mb-0">Silakan hubungi Kantor Desa Ulukalo melalui alamat, telepon/WA, email, atau
                            formulir berikut.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="current">Kontak</li>
                </ol>
            </div>
        </nav>
    </div>
    <section id="contact" class="contact section">
        <div class="container">

            <div class="row gy-4 mb-5">
                <div class="col-lg-4">
                    <div class="info-card">
                        <div class="icon-box"><i class="bi bi-geo-alt"></i></div>
                        <h3>Alamat Kantor</h3>
                        {{-- Mengambil data alamat dari controller --}}
                        <p>{{ $kontak['alamat'] }}</p>
                        <a class="small" target="_blank" rel="noopener" href="{{ $kontak['link_gmaps'] }}">Lihat di Google
                            Maps</a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="info-card">
                        <div class="icon-box"><i class="bi bi-telephone"></i></div>
                        <h3>Kontak</h3>
                        {{-- Mengambil data telepon & email dari controller --}}
                        <p>Telp/WA: <a href="{{ $kontak['link_wa'] }}">{{ $kontak['telepon'] }}</a><br>
                            Email: <a href="mailto:{{ $kontak['email'] }}">{{ $kontak['email'] }}</a></p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="info-card">
                        <div class="icon-box"><i class="bi bi-clock"></i></div>
                        <h3>Jam Layanan</h3>
                        {{-- Mengambil data jam layanan dari controller --}}
                        <p>{!! $kontak['jam_layanan'] !!}</p>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-12">
                    <div class="ratio ratio-16x9 rounded-3 overflow-hidden">
                        {{-- Mengambil link embed Google Maps dari controller --}}
                        <iframe src="{{ $kontak['link_gmaps_embed'] }}" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="Peta Desa Ulukalo"></iframe>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-wrapper">
                        {{-- Form ini tidak mengirim ke server, tapi membuka aplikasi email (mailto) --}}
                        <form id="formKontak" class="php-email-form">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" name="nama" class="form-control"
                                            placeholder="Nama lengkap*" required>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Alamat email*" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6 form-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                        <input type="text" class="form-control" name="phone"
                                            placeholder="No. HP/WA (opsional)">
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-list"></i></span>
                                        <input type="text" class="form-control" name="subject"
                                            placeholder="Subjek pesan*" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-chat-dots"></i></span>
                                    <textarea class="form-control" name="message" rows="6" placeholder="Tulis pesan anda*" required></textarea>
                                </div>
                            </div>
                            <div id="formStatus" class="my-3">
                                <div class="loading">Mengirim...</div>
                                <div class="error-message"></div>
                                <div class="sent-message" style="display:none">Pesan siap dikirim melalui aplikasi email
                                    Anda. Terima kasih!</div>
                            </div>
                            <div class="text-center">
                                <button type="submit">Kirim Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
</section>@endsection

@push('scripts')
    <script>
        // Mengambil email desa dari data yang dikirim controller
        const EMAIL_DESA = "{{ $kontak['email'] }}";

        const form = document.getElementById('formKontak');
        const loading = document.querySelector('#formStatus .loading');
        const sent = document.querySelector('#formStatus .sent-message');
        const err = document.querySelector('#formStatus .error-message');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            err.style.display = 'none';
            sent.style.display = 'none';
            loading.style.display = 'block';

            try {
                const fd = new FormData(form);
                const nama = (fd.get('nama') || '').trim();
                const email = (fd.get('email') || '').trim();
                const phone = (fd.get('phone') || '').trim();
                const subject = (fd.get('subject') || 'Pesan dari Website Desa Ulukalo').trim();
                const message = (fd.get('message') || '').trim();

                const body = `Nama: ${nama}\nEmail: ${email}${phone?'\nTelp/WA: '+phone:''}\n\nPesan:\n${message}`;
                const url =
                    `mailto:${EMAIL_DESA}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;

                loading.style.display = 'none';
                sent.style.display = 'block';
                window.location.href = url;

                // Reset form setelah beberapa saat
                setTimeout(() => {
                    form.reset();
                    sent.style.display = 'none';
                }, 3000);

            } catch (ex) {
                loading.style.display = 'none';
                err.textContent = 'Terjadi kesalahan. Silakan hubungi kami via WA atau email langsung.';
                err.style.display = 'block';
            }
        });
    </script>
@endpush
