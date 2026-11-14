
@extends('layouts.app')

@section('title', 'Detail Transaksi')
@section('heading', 'Detail Transaksi')

@section('content')
<div class="mb-4">
    <a href="{{ route('transaksi.index') }}"
       class="text-decoration-none text-muted">
        <i class="bi bi-arrow-left"></i> Kembali ke transaksi
    </a>
</div>

<div class="card p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
            <small class="text-muted">Nomor transaksi</small>
            <h3 class="fw-bold mb-1">#{{ $data['id'] }}</h3>
            <span class="text-muted">
                {{ date('d F Y', strtotime($data['tanggal'])) }}
            </span>
        </div>

        @if($data['jenis'] === 'Pemasukan')
            <span class="badge text-bg-success px-3 py-2">Pemasukan</span>
        @else
            <span class="badge text-bg-danger px-3 py-2">Pengeluaran</span>
        @endif
    </div>

    <hr>

    <div class="row g-4">
        <div class="col-md-6">
            <small class="text-muted">Keterangan Transaksi</small>
            <h5 class="fw-semibold mt-1">{{ $data['keterangan'] }}</h5>
        </div>

        <div class="col-md-6">
            <small class="text-muted">Kategori</small>
            <h5 class="fw-semibold mt-1">{{ $data['kategori'] }}</h5>
        </div>

        <div class="col-md-6">
            <small class="text-muted">Tanggal Transaksi</small>
            <h6 class="mt-1">{{ date('d/m/Y', strtotime($data['tanggal'])) }}</h6>
        </div>

        <div class="col-md-6">
            <small class="text-muted">Jenis Transaksi</small>
            <h6 class="mt-1">{{ $data['jenis'] }}</h6>
        </div>
    </div>

    <div class="rounded-3 p-4 mt-4" style="background:#f5f7fb">
        <small class="text-muted">Nominal Transaksi</small>
        <h2 class="fw-bold mt-2 mb-0 {{ $data['jenis'] === 'Pemasukan' ? 'text-success' : 'text-danger' }}">
            {{ $data['jenis'] === 'Pemasukan' ? '+' : '-' }}
            Rp {{ number_format($data['nominal'], 0, ',', '.') }}
        </h2>
    </div>

    <div class="mt-4">
        <a href="{{ route('transaksi.index') }}" class="btn btn-dark">
            Kembali ke Daftar Transaksi
        </a>
    </div>
</div>
@endsection
