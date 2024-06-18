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

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Inline Custom CSS -->
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
        .greyed-out-text {
            color: #6c757d; /* Slightly greyed out color */
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
        .table .badge-returned {
            background-color: #e9ecef;
            color: #28a745; /* Green color for returned */
        }
        .table .badge-not-confirmed {
            background-color: #e9ecef;
            color: #6c757d;
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
        .add-member-btn {
            height: 38px;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
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
            background-color: #28a745 !important;
            border-color: #28a745 !important;
            color: white !important;
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
        .btn-link {
            color: #6c757d;
            text-decoration: none;
        }
        .btn-link:hover {
            color: #343a40;
            text-decoration: underline;
        }
        .dropdown-toggle::after {
            display: none;
        }
        .pagination {
            display: flex;
            justify-content: center;
            padding-left: 0;
            list-style: none;
            border-radius: 0.25rem;
        }
        .pagination li {
            margin: 0 0.25rem;
        }
        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }
        .pagination .page-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #007bff;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .pagination .page-link:hover {
            color: #0056b3;
            text-decoration: none;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }
        .table-header-gray th {
            background-color: #f8f9fa; /* Gray color */
        }
    </style>

</head>
<body>
<div id="app">
    @auth
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @if(auth()->check() && auth()->user()->role !== 'supervisor')
                    <a class="navbar-brand" href="{{ url('/dashboard') }}">Home</a>
                @endif
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @if(auth()->check())
                            @if(auth()->user()->role !== 'supervisor')
                                <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}">Books</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('members.index') }}">Members</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('borrow-records.index') }}">Borrow Records</a></li>
                            @endif
                            @if(auth()->user()->role === 'supervisor')
                                <li class="nav-item"><a class="nav-link" href="{{ route('volunteers.index') }}">Volunteers</a></li>
                            @endif
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link">Logout</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlHj4pPb2IQTZT3Vf4q8j1r5dY9a2l8bXlHkfbPzNs/Su4/46Cfl1cRWG5y" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9nGp6Yjq4aI4nrQy0K1IZ4Q2nn+ryjXD5O3V/rImRxDZW8UPDAaXtke" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // Ensure dropdowns are initialized
        $('.dropdown-toggle').dropdown();
    });
</script>
</body>
</html>
