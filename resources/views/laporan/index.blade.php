
@extends('layouts.app')

@section('title', 'Laporan Laba Rugi')
@section('heading', 'Laporan Laba-Rugi')

@section('content')
<p class="text-muted mb-4">
    Ringkasan hasil pemasukan dan pengeluaran Kedai Kopi Berkah.
</p>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card p-4 h-100">
            <small class="text-muted">Total Pemasukan</small>
            <h4 class="fw-bold text-success mt-2">
                Rp {{ number_format($pemasukan, 0, ',', '.') }}
            </h4>
            <small class="text-muted">Akumulasi seluruh pemasukan</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4 h-100">
            <small class="text-muted">Total Pengeluaran</small>
            <h4 class="fw-bold text-danger mt-2">
                Rp {{ number_format($pengeluaran, 0, ',', '.') }}
            </h4>
            <small class="text-muted">Akumulasi seluruh pengeluaran</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4 h-100">
            <small class="text-muted">{{ $labaRugi >= 0 ? 'Laba Bersih' : 'Kerugian' }}</small>
            <h4 class="fw-bold mt-2 {{ $labaRugi >= 0 ? 'text-success' : 'text-danger' }}">
                Rp {{ number_format(abs($labaRugi), 0, ',', '.') }}
            </h4>
            <small class="text-muted">Selisih pemasukan dan pengeluaran</small>
        </div>
    </div>
</div>

<div class="card p-4 mb-4">
    <h5 class="fw-bold mb-3">Ringkasan Laba-Rugi</h5>

    <div class="table-responsive">
        <table class="table align-middle">
            <tbody>
                <tr>
                    <td>Total Pemasukan</td>
                    <td class="text-end text-success fw-semibold">
                        Rp {{ number_format($pemasukan, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td>Total Pengeluaran</td>
                    <td class="text-end text-danger fw-semibold">
                        Rp {{ number_format($pengeluaran, 0, ',', '.') }}
                    </td>
                </tr>
                <tr class="table-light">
                    <th>{{ $labaRugi >= 0 ? 'Laba Bersih' : 'Rugi Bersih' }}</th>
                    <th class="text-end">
                        Rp {{ number_format(abs($labaRugi), 0, ',', '.') }}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>

    @if($labaRugi > 0)
        <div class="alert alert-success mb-0">
            <strong>Kondisi usaha menghasilkan laba.</strong>
            Pemasukan lebih besar daripada pengeluaran.
        </div>
    @elseif($labaRugi < 0)
        <div class="alert alert-danger mb-0">
            <strong>Kondisi usaha mengalami kerugian.</strong>
            Pengeluaran lebih besar daripada pemasukan.
        </div>
    @else
        <div class="alert alert-warning mb-0">
            Pemasukan dan pengeluaran berada dalam kondisi seimbang.
        </div>
    @endif
</div>

<div class="card p-4">
    <h5 class="fw-bold mb-3">Laporan Keuangan Bulanan</h5>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Periode</th>
                    <th class="text-end">Pemasukan</th>
                    <th class="text-end">Pengeluaran</th>
                    <th class="text-end">Laba / Rugi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bulanan as $bulan => $item)
                <tr>
                    <td class="fw-semibold">{{ $bulan }}</td>
                    <td class="text-end text-success">
                        Rp {{ number_format($item['pemasukan'], 0, ',', '.') }}
                    </td>
                    <td class="text-end text-danger">
                        Rp {{ number_format($item['pengeluaran'], 0, ',', '.') }}
                    </td>
                    <td class="text-end fw-semibold">
                        Rp {{ number_format(abs($item['labaRugi']), 0, ',', '.') }}
                        {{ $item['labaRugi'] < 0 ? '(Rugi)' : '' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        Belum ada data laporan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
