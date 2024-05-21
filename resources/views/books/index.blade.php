@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Books</h1>
                    <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
                </div>
                <div class="row">
                    @foreach($books as $book)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Author: {{ $book->author }}</h6>
                                    <p class="card-text">
                                        <strong>Publisher:</strong> {{ $book->publisher_name }}<br>
                                        <strong>Published Year:</strong> {{ $book->published_year }}<br>
                                        <strong>Category:</strong> {{ $book->category }}
                                    </p>
                                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">
                                        Borrowed by:
                                        <ul class="list-unstyled mb-0">
                                            @foreach($book->borrowRecords as $record)
                                                <li>{{ $record->member->name }},
                                                    @if ($record->return_date)
                                                        Return Date: {{ $record->return_date }}
                                                    @else
                                                        Not returned yet
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $books->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
