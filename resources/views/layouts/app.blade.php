<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - FinTrack UMKM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>
        body {
            background: #f4f7fb;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background: #172554;
            min-height: 100vh;
            color: white;
            padding: 25px 15px;
        }

        .sidebar a {
            display: block;
            color: #dbeafe;
            text-decoration: none;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 7px;
        }

        .sidebar a:hover {
            background: #1e40af;
            color: white;
        }

        .main-content {
            padding: 30px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,.05);
        }

        .table {
            vertical-align: middle;
        }


/* Menu Sidebar */
.sidebar .nav-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    margin-bottom: 5px;
    border-radius: 10px;
    color: #aebbd0;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.25s ease;
}

/* Efek ketika mouse diarahkan */
.sidebar .nav-link:hover {
    background: rgba(255, 255, 255, 0.08);
    color: #ffffff;
    transform: translateX(3px);
}

/* Menu yang sedang aktif */
.sidebar .nav-link.active {
    background: #10b981;
    color: #ffffff;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
}

/* Ukuran ikon */
.sidebar .nav-link i {
    font-size: 18px;
    width: 22px;
    text-align: center;
}

    </style>

    @stack('styles')
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 sidebar">
            <h4 class="mb-4">FinTrack</h4>

            
<nav class="d-flex flex-column gap-2">
    <a href="{{ route('dashboard') }}"
       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid-1x2"></i>
        <span>Dashboard</span>
    </a>

    <a href="{{ route('transaksi.index') }}"
       class="nav-link {{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
        <i class="bi bi-arrow-left-right"></i>
        <span>Transaksi</span>
    </a>

    <a href="{{ route('laporan.index') }}"
       class="nav-link {{ request()->routeIs('laporan.index') ? 'active' : '' }}">
        <i class="bi bi-file-earmark-bar-graph"></i>
        <span>Laporan Laba-Rugi</span>
    </a>

    <a href="{{ route('laporan.analisis') }}"
       class="nav-link {{ request()->routeIs('laporan.analisis') ? 'active' : '' }}">
        <i class="bi bi-pie-chart"></i>
        <span>Analisis Keuangan</span>
    </a>
</nav>

        </div>

        <div class="col-md-10 main-content">

            @yield('content')

        </div>

    </div>
</div>

@stack('scripts')
</body>
</html>
