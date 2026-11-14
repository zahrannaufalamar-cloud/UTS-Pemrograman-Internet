<?php

namespace App\Http\Controllers;

use App\Data\DataTransaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $transaksi = DataTransaksi::semua();

        $pemasukan = 0;
        $pengeluaran = 0;

        foreach ($transaksi as $item) {

            if ($item['jenis'] == 'Pemasukan') {
                $pemasukan += $item['nominal'];
            } else {
                $pengeluaran += $item['nominal'];
            }
        }

        $labaRugi = $pemasukan - $pengeluaran;

        return view('dashboard', compact(
            'transaksi',
            'pemasukan',
            'pengeluaran',
            'labaRugi'
        ));
    }
}
