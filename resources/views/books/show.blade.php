@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4">{{ $book->title }}</h1>
                <div class="card">
                    <div class="card-body">
                        <p><strong>Title:</strong> {{ $book->title }}</p>
                        <p><strong>Author:</strong> {{ $book->author }}</p>
                        <p><strong>Publisher Name:</strong> {{ $book->publisher_name }}</p>
                        <p><strong>Published Year:</strong> {{ $book->published_year }}</p>
                        <p><strong>Category:</strong> {{ $book->category }}</p>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
