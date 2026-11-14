<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;

// Halaman Dashboard
Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

// Halaman Transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])
    ->name('transaksi.index');

// Detail transaksi
Route::get('/transaksi/detail/{id}', [TransaksiController::class, 'show'])
    ->name('transaksi.show');

// Filter kategori
Route::get('/transaksi/kategori/{kategori}', [TransaksiController::class, 'kategori'])
    ->name('transaksi.kategori');

// Filter periode
Route::get('/transaksi/periode/{bulan}', [TransaksiController::class, 'periode'])
    ->name('transaksi.periode');

// Laporan laba rugi
Route::get('/laporan', [LaporanController::class, 'index'])
    ->name('laporan.index');

// Analisis keuangan
Route::get('/laporan/analisis', [LaporanController::class, 'analisis'])
    ->name('laporan.analisis');
