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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

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
                                <a class="nav-link active" href="#">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    User
                                </a>
                            </li>
                        @endif
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Daftar Obat
                                </a>
                            </li>
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
</body>
</html>
