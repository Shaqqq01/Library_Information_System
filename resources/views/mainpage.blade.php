<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Routes</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navigation</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <!-- Add other nav items here -->
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <h1>Main Page</h1>
    <div class="list-group">
        <a href="{{ route('books.index') }}" class="list-group-item list-group-item-action">Books</a>
        <a href="{{ route('members.index') }}" class="list-group-item list-group-item-action">Members</a>
        <a href="{{ route('borrow-records.index') }}" class="list-group-item list-group-item-action">Borrow Records</a>
        @if(auth()->user()->role === 'supervisor')
            <a href="{{ route('volunteers.index') }}" class="list-group-item list-group-item-action">Volunteers</a>
        @endif
        <!-- Add more links as needed -->
        <!-- Add more links as needed -->
    </div>
</div>

<!-- Bootstrap JS bundle -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
