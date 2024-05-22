<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        h1, h2 {
            color: #343a40;
        }

        .card {
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            color: #343a40;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table th {
            background-color: #f8f9fa;
        }

        .card-img-top {
            border-radius: 10px 10px 0 0;
        }

        .overflow-auto {
            white-space: nowrap;
        }

        .mr-3 {
            margin-right: 1rem !important;
        }

        .table .badge {
            display: inline-block;
            padding: 0.5em 1em;
            font-size: 0.9em;
            font-weight: 600;
            border-radius: 50px;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
            background-color: #e9ecef;
            color: #495057;
        }

        .table .badge-available {
            background-color: #e9ecef;
            color: #28a745;
        }

        .table .badge-checked-out {
            background-color: #e9ecef;
            color: #dc3545;
        }

        .input-group {
            border-radius: 5px;
        }

        .input-group-append .btn {
            border-radius: 0 5px 5px 0;
        }

        .add-book-btn {
            border-radius: 5px;
        }

        .container {
            max-width: 1200px;
        }

        .member-list {
            border-right: 1px solid #ddd;
            padding-right: 20px;
        }

        .member-list a {
            text-decoration: none;
            color: #000;
        }

        .member-list a:hover {
            background-color: #f8f9fa;
        }

        .member-details {
            padding-left: 20px;
        }

        .member-details h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .member-details .detail-item {
            margin-bottom: 10px;
        }

        .member-details .detail-item span {
            font-weight: bold;
        }

        .badge-returned {
            background-color: #e9ecef;
            color: #28a745;
        }

        .badge-overdue {
            background-color: #e9ecef;
            color: #dc3545;
        }

        .badge-not-confirmed {
            background-color: #e9ecef;
            color: #6c757d;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .search-bar input {
            width: calc(100% - 50px);
            border-radius: 5px 0 0 5px;
            border-right: 0;
        }

        .search-bar button {
            width: 50px;
            border-radius: 0 5px 5px 0;
        }

        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .text-center {
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .d-inline {
            display: inline-block;
        }

        .d-flex {
            display: flex;
        }

        .justify-content-end {
            justify-content: flex-end;
        }

        .justify-content-center {
            justify-content: center;
        }

        .mr-2 {
            margin-right: 0.5rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .display-4 {
            font-size: 2.5rem;
            font-weight: 300;
            line-height: 1.2;
        }

        .card-deck .card {
            flex: 1 0 0%;
        }
    </style>

    <!-- Additional Styles -->
    @yield('styles')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    @auth
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @if(auth()->check() && auth()->user()->role !== 'supervisor')
                    <a class="navbar-brand" href="{{ url('/dashboard') }}">
                    Home
                    </a>
                @endif
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @if(auth()->check())
                            @if(auth()->user()->role !== 'supervisor')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('books.index') }}">Books</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('members.index') }}">Members</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('borrow-records.index') }}">Borrow Records</a>
                                </li>
                            @endif
                            @if(auth()->user()->role === 'supervisor')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('volunteers.index') }}">Volunteers</a>
                                </li>
                            @endif
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link">Logout</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>

                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    @endauth

    <main class="py-4">
        @yield('content')
    </main>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
