<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Project</title>
    
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css ') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/png">
    
<link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">
<link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}">

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <nav class="main-navbar">
                    <div class="container">
                        <ul>
                            <li
                                class="menu-item  ">
                                <a href="/" class='menu-link'>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li
                                class="menu-item  ">
                                <a href="/mahasiswa" class='menu-link'>
                                    <span>Mahasiswa</span>
                                </a>
                            </li>
                            <li
                                class="menu-item  ">
                                <a href="/matakuliah" class='menu-link'>
                                    <span>Matakuliah</span>
                                </a>
                            </li>
                            <li
                                class="menu-item  ">
                                <a href="/absen" class='menu-link'>
                                    <span>Absen</span>
                                </a>
                            </li>
                            <li
                                class="menu-item  ">
                                <a href="/kontrak" class='menu-link'>
                                    <span>Kontrak</span>
                                </a>
                            </li>
                            <li
                                class="menu-item  ">
                                <a href="/jadwal" class='menu-link'>
                                    <span>Jadwal</span>
                                </a>
                            </li>
                            <li
                                class="menu-item  ">
                                <a href="/semester" class='menu-link'>
                                    <span>Semester</span>
                                </a>
                            </li>
                            <li
                                class="menu-item">
                                <a href="/logout" class='menu-link'>
                                    <span>Keluar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

            </header>

            <div class="content-wrapper container">
                
                <div class="page-heading">
                    <h3>Hallo, {{ auth()->user()->name }}!</h3>
                </div>
                <div class="page-content">
                    <section class="row">
                        @yield('content')
                    </section>
                </div>

            </div>

            <footer>
                <div class="container">
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2022 &copy; Pina</p>
                        </div>
                        <div class="float-end">
                            <p>Crafted by <span class="text-danger"><i class="#"></i></span> <a
                                href="https://pina.me">Pinaap</a></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/pages/horizontal-layout.js') }}"></script>
    
<script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/js/pages/simple-datatables.js') }}"></script>

</body>

</html>
