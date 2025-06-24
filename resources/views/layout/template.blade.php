<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Geospasial Web' }}</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <!-- NAVBAR CANTIK SAGE PROFESSIONAL -->
    <style>
        .navbar {
            background: linear-gradient(to right, #c8d5b9, #a7c7a3);
            padding: 0.8rem 1.5rem;
            height: 64px;
            border-radius: 0 0 16px 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            color: #2e4e1e !important;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-brand i {
            color: #446c39;
        }

        .navbar-nav .nav-link {
            color: #2f4f4f !important;
            font-weight: 500;
            border-radius: 10px;
            padding: 8px 14px;
            margin: 0 4px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            background-color: rgba(255, 255, 255, 0.3);
            color: #1d2c1d !important;
        }

        .dropdown-menu {
            border-radius: 12px;
            border: none;
            background-color: #f7faf7;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.12);
        }

        .dropdown-item:hover {
            background-color: #dfeede;
            color: #2e4e1e;
            border-radius: 8px;
        }

        .nav-link.text-danger {
            color: #b30000 !important;
        }

        .nav-link.text-primary {
            color: #206030 !important;
            font-weight: 600;
        }

        .navbar-toggler {
            border: none;
            background-color: rgba(255, 255, 255, 0.4);
            padding: 0.5rem 0.8rem;
            border-radius: 8px;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23333' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(0,0,0,0.5)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
    </style>

    @yield('styles')
</head>

<body>
    @include('components.navbar')

    <div class="container-fluid px-5 py-4">
    <div class="mx-auto" style="max-width: 1400px;">
        @yield('content')
    </div>
</div>
</div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
    @include('components.toast')
</body>

</html>
