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

    <section class="section">
        <div class="container">
            <div class="row g-3 align-items-center mb-3">
                <div class="col-md-4">
                    <label class="form-label mb-1">Tahun Anggaran</label>
                    <form method="GET" action="{{ route('apbdes.index') }}">
                        <select name="tahun" class="form-select year-select" onchange="this.form.submit()">
                            @foreach ($years as $y)
                                <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @if ($apbdes)
        <section class="section pt-0">
            <div class="container">
                <div class="row g-3 apb-cards">
                    <div class="col-md-3">
                        <div class="card p-3">
                            <div class="label">Pendapatan</div>
                            <div class="value">Rp {{ number_format($apbdes->pendapatan, 0, ',', '.') }}</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3">
                            <div class="label">Belanja</div>
                            <div class="value">Rp {{ number_format($apbdes->belanja, 0, ',', '.') }}</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3">
                            <div class="label">Pembiayaan (Netto)</div>
                            <div class="value">Rp {{ number_format($apbdes->pembiayaan_netto, 0, ',', '.') }}</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3">
                            <div class="label">SILPA/Defisit</div>
                            <div class="value">Rp {{ number_format($apbdes->silpa_defisit, 0, ',', '.') }}</div>
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
                                    {{-- ... (isi tabel pendapatan) ... --}}
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-3 p-lg-4 border apb-section">
                            <h3 class="h5 mb-3">Rincian Belanja</h3>
                            <div class="table-responsive" style="max-height:420px;">
                                <table class="table align-middle">
                                    {{-- ... (isi tabel belanja) ... --}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="section pt-0">
            <div class="container">
                <div class="alert alert-warning text-center">
                    <p class="mb-0">Data APBDes untuk tahun anggaran <strong>{{ $tahun }}</strong> tidak ditemukan.
                    </p>
                </div>
            </div>
        </section>
    @endif


@endsection
