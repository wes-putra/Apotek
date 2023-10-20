<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Apotek') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Custom CSS -->
    <style>
        /* Set the sidebar to have a fixed height and scrollable content */
        #sidebar {
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
            background-color: #f8f9fa; /* Background color for the sidebar */
        }

        /* Style for the sidebar links */
        #sidebar .nav-link {
            color: #333; /* Text color */
            padding: 10px 20px; /* Spacing for the links */
            transition: background-color 0.3s; /* Smooth background color transition */
        }

        /* Hover effect for sidebar links */
        #sidebar .nav-link:hover {
            background-color: #e0e0e0; /* Background color on hover */
        }

        /* Style for the active sidebar link */
        #sidebar .nav-item.active .nav-link {
            background-color: #007bff; /* Background color for the active link */
            color: #fff; /* Text color for the active link */
        }

        /* Style for the logo */
        #sidebar .navbar-brand {
            background-color: #007bff; /* Background color for the logo */
            color: #fff; /* Text color for the logo */
            padding: 15px 20px; /* Spacing for the logo */
        }

        /* Adjust main content to leave space for the sidebar */
        #main-content {
            margin-left: 250px; /* Adjust this value to match the sidebar width */
            transition: margin-left 0.3s; /* Smooth transition for main content */
        }

        /* Add some padding to the main content */
        #main-content .container {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Apotek') }}
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                                <li class="nav-item">
                                    <a class="nav-link">{{ __('Selamat Datang') }}</a>
                                </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    @if(Auth::check())
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                    <div class="position-sticky">
                        <ul class="nav flex-column">
                        @if(Auth::user()->Super())
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('super.dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('user.index')}}">
                                    User
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('superobat.index')}}">
                                    Daftar Obat
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('transaksi.index')}}">
                                Transaksi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('penjualan.index')}}">
                                Penjualan
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->Admin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('adminobat.index') }}">
                                    Daftar Obat
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('transaksi.index')}}">
                                Transaksi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('penjualan.index')}}">
                                Penjualan
                                </a>
                            </li>
                        @endif
                        </ul>
                    </div>
                </nav>
                <!-- End of Sidebar -->
    
                <main id="main-content" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>
    @endif
    @guest
        @yield('content')
    @endguest
    </div>
    <script>
    // Fungsi untuk menyembunyikan pesan alert
    function hideAlert() {
        var alert = document.querySelector('.alert');
        if (alert) {
            setTimeout(function() {
                alert.style.display = 'none';
            }, 2000); // 3000 milidetik (3 detik)
        }
    }

    // Panggil fungsi hideAlert saat dokumen selesai dimuat
    document.addEventListener('DOMContentLoaded', hideAlert);
</script>
</body>
</html>
