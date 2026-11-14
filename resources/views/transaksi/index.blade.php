
@extends('layouts.app')

@section('title', 'Daftar Transaksi')
@section('heading', 'Manajemen Transaksi')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <p class="text-muted mb-0">
            Pantau seluruh pemasukan dan pengeluaran usaha.
        </p>
    </div>
    <span class="badge text-bg-success px-3 py-2">
        {{ count($transaksi) }} Transaksi Tercatat
    </span>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card p-3 h-100">
            <small class="text-muted">Total Transaksi</small>
            <h3 class="fw-bold mb-0">{{ count($transaksi) }}</h3>
            <small class="text-muted">Seluruh data transaksi</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 h-100">
            <small class="text-muted">Kategori Pemasukan</small>
            <h5 class="fw-bold text-success mb-0">Penjualan</h5>
            <small class="text-muted">Pendapatan usaha</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 h-100">
            <small class="text-muted">Kategori Pengeluaran</small>
            <h5 class="fw-bold mb-0">3 Kategori</h5>
            <small class="text-muted">Bahan Baku, Operasional, Perlengkapan</small>
        </div>
    </div>
</div>

<div class="card p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
        <div>
            <h5 class="fw-bold mb-1">Riwayat Transaksi</h5>
            <small class="text-muted">Daftar seluruh aktivitas keuangan UMKM</small>
        </div>

        <input type="search"
               id="cariTransaksi"
               class="form-control"
               style="max-width:260px"
               placeholder="Cari transaksi...">
    </div>

    <div class="d-flex flex-wrap gap-2 mb-3">
        <a href="{{ route('transaksi.index') }}"
           class="btn btn-sm btn-dark">Semua</a>

        <a href="{{ route('transaksi.kategori', 'Penjualan') }}"
           class="btn btn-sm btn-outline-success">Penjualan</a>

        <a href="{{ route('transaksi.kategori', 'Bahan Baku') }}"
           class="btn btn-sm btn-outline-secondary">Bahan Baku</a>

        <a href="{{ route('transaksi.kategori', 'Operasional') }}"
           class="btn btn-sm btn-outline-secondary">Operasional</a>

        <a href="{{ route('transaksi.kategori', 'Perlengkapan') }}"
           class="btn btn-sm btn-outline-secondary">Perlengkapan</a>
    </div>

    <div class="d-flex flex-wrap gap-2 mb-3">
    <a href="{{ route('transaksi.periode', '2026-09') }}"
       class="btn btn-sm btn-outline-primary">
        September 2026
    </a>

    <a href="{{ route('transaksi.periode', '2026-10') }}"
       class="btn btn-sm btn-outline-primary">
        Oktober 2026
    </a>
</div>

    <div class="table-responsive">
        <table class="table align-middle" id="tabelTransaksi">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Kategori</th>
                    <th>Jenis</th>
                    <th class="text-end">Nominal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $item)
                <tr>
                    <td class="text-muted">#{{ $item['id'] }}</td>
                    <td>{{ date('d/m/Y', strtotime($item['tanggal'])) }}</td>
                    <td class="fw-semibold">{{ $item['keterangan'] }}</td>
                    <td>{{ $item['kategori'] }}</td>
                    <td>
                        @if($item['jenis'] === 'Pemasukan')
                            <span class="badge text-bg-success">Pemasukan</span>
                        @else
                            <span class="badge text-bg-danger">Pengeluaran</span>
                        @endif
                    </td>
                    <td class="text-end fw-semibold">
                        Rp {{ number_format($item['nominal'], 0, ',', '.') }}
                    </td>
                    <td>
                        <a href="{{ route('transaksi.show', $item['id']) }}"
                           class="btn btn-sm btn-outline-primary">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        Belum ada transaksi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('cariTransaksi').addEventListener('input', function () {
        const kataKunci = this.value.toLowerCase();

        document.querySelectorAll('#tabelTransaksi tbody tr').forEach(function (baris) {
            baris.style.display = baris.textContent.toLowerCase().includes(kataKunci)
                ? ''
                : 'none';
        });
    });
</script>
@endpush
@endsection
