@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Book Record Details</h2>
                    </div>
                    <div class="card-body">
                        <p><strong>Title:</strong> {{ $book->title }}</p>
                        <p><strong>Author:</strong> {{ $book->author }}</p>
                        <p><strong>Publisher Name:</strong> {{ $book->publisher_name }}</p>
                        <p><strong>Published Year:</strong> {{ $book->published_year }}</p>
                        <p><strong>Category:</strong> {{ $book->category }}</p>
                        <!-- Add more details if necessary -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
