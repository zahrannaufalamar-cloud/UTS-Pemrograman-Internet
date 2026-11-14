<?php

namespace App\Http\Controllers;

use App\Data\DataTransaksi;

class LaporanController extends Controller
{
    private function hitungKeuangan()
    {
        $transaksi = DataTransaksi::semua();

        $pemasukan = 0;
        $pengeluaran = 0;
        $kategori = [];
        $bulanan = [];

        foreach ($transaksi as $item) {
            $bulan = substr($item['tanggal'], 0, 7);

            if (!isset($bulanan[$bulan])) {
                $bulanan[$bulan] = [
                    'pemasukan' => 0,
                    'pengeluaran' => 0,
                    'labaRugi' => 0,
                ];
            }

            if ($item['jenis'] === 'Pemasukan') {
                $pemasukan += $item['nominal'];
                $bulanan[$bulan]['pemasukan'] += $item['nominal'];
            } else {
                $pengeluaran += $item['nominal'];
                $bulanan[$bulan]['pengeluaran'] += $item['nominal'];

                $namaKategori = $item['kategori'];

                if (!isset($kategori[$namaKategori])) {
                    $kategori[$namaKategori] = 0;
                }

                $kategori[$namaKategori] += $item['nominal'];
            }
        }

        // Menghitung laba-rugi setiap bulan
        foreach ($bulanan as $bulan => $data) {
            $bulanan[$bulan]['labaRugi'] =
                $data['pemasukan'] - $data['pengeluaran'];
        }

        // Menghitung persentase pengeluaran kategori
        $analisisKategori = [];

        foreach ($kategori as $nama => $jumlah) {
            $persentase = $pengeluaran > 0
                ? ($jumlah / $pengeluaran) * 100
                : 0;

            $analisisKategori[] = [
                'nama' => $nama,
                'jumlah' => $jumlah,
                'persentase' => $persentase,
            ];
        }

        // Mengurutkan kategori dari pengeluaran terbesar
        usort($analisisKategori, function ($a, $b) {
            return $b['jumlah'] <=> $a['jumlah'];
        });

        // Menyiapkan data grafik bulanan
        $chartBulanan = [];

        foreach ($bulanan as $bulan => $data) {
            $chartBulanan[] = [
                'bulan' => $bulan,
                'pemasukan' => $data['pemasukan'],
                'pengeluaran' => $data['pengeluaran'],
                'labaRugi' => $data['labaRugi'],
            ];
        }

        $labaRugi = $pemasukan - $pengeluaran;

        return [
            'transaksi' => $transaksi,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'labaRugi' => $labaRugi,
            'kategori' => $analisisKategori,
            'bulanan' => $bulanan,
            'chartBulanan' => $chartBulanan,
            'kategoriTerbesar' => $analisisKategori[0] ?? null,
        ];
    }

    public function index()
    {
        $data = $this->hitungKeuangan();

        return view('laporan.index', $data);
    }

    public function analisis()
    {
        $data = $this->hitungKeuangan();

        return view('laporan.analisis', $data);
    }
}
