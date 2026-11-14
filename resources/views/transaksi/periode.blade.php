
@extends('layouts.app')

@section('title', 'Filter Periode')
@section('heading', 'Transaksi Berdasarkan Periode')

@section('content')
<div class="mb-4">
    <p class="text-muted mb-0">
        Riwayat transaksi berdasarkan periode {{ $bulan }}.
    </p>
</div>

<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h5 class="fw-bold mb-1">Periode {{ $bulan }}</h5>
            <small class="text-muted">{{ count($transaksi) }} transaksi ditemukan</small>
        </div>

        <a href="{{ route('transaksi.index') }}" class="btn btn-outline-dark btn-sm">
            Semua Transaksi
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
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
                           class="btn btn-sm btn-outline-primary">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        Tidak ada transaksi pada periode ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
