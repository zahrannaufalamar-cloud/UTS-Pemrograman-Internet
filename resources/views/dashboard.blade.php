@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h2 class="fw-bold">Dashboard Keuangan</h2>
<p class="text-muted">
    Selamat datang di sistem keuangan Kedai Kopi Berkah.
</p>

<div class="row g-3 mb-4">

    <div class="col-md-4">
        <div class="card p-4">
            <p class="text-muted">Total Pemasukan</p>
            <h3 class="text-success">
                Rp {{ number_format($pemasukan, 0, ',', '.') }}
            </h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4">
            <p class="text-muted">Total Pengeluaran</p>
            <h3 class="text-danger">
                Rp {{ number_format($pengeluaran, 0, ',', '.') }}
            </h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4">
            <p class="text-muted">Laba / Rugi</p>
            <h3 class="{{ $labaRugi >= 0 ? 'text-primary' : 'text-danger' }}">
                Rp {{ number_format($labaRugi, 0, ',', '.') }}
            </h3>
        </div>
    </div>

</div>

<div class="card p-4">

    <h5 class="mb-3">Transaksi Terbaru</h5>

    <div class="table-responsive">
        <table class="table table-striped">

            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Jenis</th>
                    <th>Nominal</th>
                    <th>Detail</th>
                </tr>
            </thead>

            <tbody>
                @foreach(array_slice(array_reverse($transaksi), 0, 5) as $item)
                <tr>
                    <td>{{ $item['tanggal'] }}</td>
                    <td>{{ $item['keterangan'] }}</td>
                    <td>{{ $item['jenis'] }}</td>
                    <td>
                        Rp {{ number_format($item['nominal'], 0, ',', '.') }}
                    </td>
                    <td>
                        <a href="{{ route('transaksi.show', $item['id']) }}"
                           class="btn btn-sm btn-primary">
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ route('transaksi.index') }}" class="btn btn-primary">
        Lihat Semua Transaksi
    </a>

</div>

@endsection
