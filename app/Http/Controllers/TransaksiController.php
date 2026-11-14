<?php

namespace App\Http\Controllers;

use App\Data\DataTransaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = DataTransaksi::semua();

        return view('transaksi.index', compact('transaksi'));
    }

    public function show($id)
    {
        $transaksi = DataTransaksi::semua();

        $data = collect($transaksi)->firstWhere('id', $id);

        if (!$data) {
            abort(404);
        }

        return view('transaksi.show', compact('data'));
    }

    public function kategori($kategori)
    {
        $semuaTransaksi = DataTransaksi::semua();

        $transaksi = array_filter(
            $semuaTransaksi,
            function ($item) use ($kategori) {
                return strcasecmp($item['kategori'], $kategori) === 0;
            }
        );

        return view('transaksi.kategori', compact(
            'transaksi',
            'kategori'
        ));
    }

    public function periode($bulan)
    {
        $semuaTransaksi = DataTransaksi::semua();

        $transaksi = array_filter(
            $semuaTransaksi,
            function ($item) use ($bulan) {
                return substr($item['tanggal'], 0, 7) === $bulan;
            }
        );

        return view('transaksi.periode', compact(
            'transaksi',
            'bulan'
        ));
    }
}
