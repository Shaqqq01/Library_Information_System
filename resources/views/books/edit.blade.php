@extends('layouts.app')

@section('content')
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
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4">Edit Book</h1>
                <form action="{{ route('books.update', $book->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Author:</label>
                        <input type="text" class="form-control" id="author" name="author" value="{{ $book->author }}">
                    </div>
                    <div class="mb-3">
                        <label for="publisher_name" class="form-label">Publisher Name:</label>
                        <input type="text" class="form-control" id="publisher_name" name="publisher_name" value="{{ $book->publisher_name }}">
                    </div>
                    <div class="mb-3">
                        <label for="published_year" class="form-label">Published Year:</label>
                        <input type="text" class="form-control" id="published_year" name="published_year" value="{{ $book->published_year }}">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category:</label>
                        <input type="text" class="form-control" id="category" name="category" value="{{ $book->category }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
