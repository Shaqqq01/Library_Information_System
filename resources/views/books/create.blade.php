@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4">Add New Book</h1>
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Author:</label>
                        <input type="text" class="form-control" id="author" name="author">
                    </div>
                    <div class="mb-3">
                        <label for="publisher_name" class="form-label">Publisher Name:</label>
                        <input type="text" class="form-control" id="publisher_name" name="publisher_name">
                    </div>
                    <div class="mb-3">
                        <label for="published_year" class="form-label">Published Year:</label>
                        <input type="text" class="form-control" id="published_year" name="published_year">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category:</label>
                        <input type="text" class="form-control" id="category" name="category">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
