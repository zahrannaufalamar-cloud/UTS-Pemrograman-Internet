@extends('layouts.app')

@section('title', 'Analisis Keuangan')
@section('heading', 'Analisis Keuangan')

@section('content')
<p class="text-muted mb-4">
    Pahami pola pengeluaran dan perkembangan keuangan usaha.
</p>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card p-4 h-100">
            <small class="text-muted">Kategori Pengeluaran Terbesar</small>

            @if($kategoriTerbesar)
                <h4 class="fw-bold mt-2 mb-1">
                    {{ $kategoriTerbesar['nama'] }}
                </h4>
                <h5 class="text-danger">
                    Rp {{ number_format($kategoriTerbesar['jumlah'], 0, ',', '.') }}
                </h5>
                <small class="text-muted">
                    {{ number_format($kategoriTerbesar['persentase'], 2) }}%
                    dari seluruh pengeluaran
                </small>
            @else
                <h5 class="mt-2">Belum ada data pengeluaran</h5>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-4 h-100">
            <small class="text-muted">Kondisi Keuangan</small>
            <h4 class="fw-bold mt-2 {{ $labaRugi >= 0 ? 'text-success' : 'text-danger' }}">
                {{ $labaRugi > 0 ? 'Menghasilkan Laba' : ($labaRugi < 0 ? 'Mengalami Kerugian' : 'Seimbang') }}
            </h4>
            <h5>Rp {{ number_format(abs($labaRugi), 0, ',', '.') }}</h5>
            <small class="text-muted">Hasil selisih pemasukan dan pengeluaran</small>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-lg-7">
        <div class="card p-4 h-100">
            <h5 class="fw-bold mb-1">Perbandingan Keuangan Bulanan</h5>
            <small class="text-muted">Pemasukan dan pengeluaran setiap bulan</small>

            <div class="mt-4">
                <canvas id="grafikBulanan" height="120"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card p-4 h-100">
            <h5 class="fw-bold mb-1">Komposisi Pengeluaran</h5>
            <small class="text-muted">Persentase berdasarkan kategori</small>

            @if(count($kategori) > 0)
                <div class="mt-3">
                    <canvas id="grafikKategori"></canvas>
                </div>
            @else
                <div class="text-center text-muted py-5">
                    Belum ada data untuk ditampilkan.
                </div>
            @endif
        </div>
    </div>
</div>

<div class="card p-4 mb-4">
    <h5 class="fw-bold mb-1">Rincian Pengeluaran per Kategori</h5>
    <small class="text-muted">Pengelompokan dan persentase pengeluaran</small>

    <div class="table-responsive mt-3">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th class="text-end">Jumlah</th>
                    <th class="text-end">Persentase</th>
                    <th style="min-width:150px">Proporsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $item)
                <tr>
                    <td class="fw-semibold">{{ $item['nama'] }}</td>
                    <td class="text-end">
                        Rp {{ number_format($item['jumlah'], 0, ',', '.') }}
                    </td>
                    <td class="text-end">
                        {{ number_format($item['persentase'], 2) }}%
                    </td>
                    <td>
                        <div class="progress" style="height:8px">
                            <div class="progress-bar bg-success"
                                 role="progressbar"
                                 style="width: {{ $item['persentase'] }}%">
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        Belum terdapat data pengeluaran.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card p-4">
    <h5 class="fw-bold mb-2">Insight Keuangan</h5>

    @if($kategoriTerbesar)
        <p class="mb-2">
            Kategori <strong>{{ $kategoriTerbesar['nama'] }}</strong>
            menjadi pengeluaran terbesar dengan nilai
            <strong>Rp {{ number_format($kategoriTerbesar['jumlah'], 0, ',', '.') }}</strong>.
        </p>
        <p class="text-muted mb-0">
            Pemilik usaha dapat mengevaluasi kebutuhan pada kategori tersebut
            agar pengeluaran tetap sesuai dengan kebutuhan operasional.
        </p>
    @else
        <p class="text-muted mb-0">
            Belum tersedia data yang cukup untuk menghasilkan insight pengeluaran.
        </p>
    @endif
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dataBulanan = @json($chartBulanan);
    const dataKategori = @json($kategori);

    new Chart(document.getElementById('grafikBulanan'), {
        type: 'bar',
        data: {
            labels: dataBulanan.map(item => item.bulan),
            datasets: [
                {
                    label: 'Pemasukan',
                    data: dataBulanan.map(item => item.pemasukan),
                    backgroundColor: '#10b981',
                    borderRadius: 6
                },
                {
                    label: 'Pengeluaran',
                    data: dataBulanan.map(item => item.pengeluaran),
                    backgroundColor: '#f87171',
                    borderRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }
                }
            }
        }
    });

    if (dataKategori.length > 0) {
        new Chart(document.getElementById('grafikKategori'), {
            type: 'doughnut',
            data: {
                labels: dataKategori.map(item => item.nama),
                datasets: [{
                    data: dataKategori.map(item => item.jumlah),
                    backgroundColor: ['#10b981', '#3b82f6', '#f59e0b'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
</script>
@endpush
@endsection
