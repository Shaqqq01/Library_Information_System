@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="mb-4 text-center">Manage your library</h1>

        <div class="row mb-4">
            <div class="col-md-8 mx-auto d-flex justify-content-between">
                <form action="{{ route('books.index') }}" method="GET" class="d-flex flex-grow-1">
                    <div class="input-group flex-grow-1">
                        <input type="text" name="search" class="form-control" placeholder="Search for a book" value="{{ request()->query('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('books.create') }}" class="btn btn-success add-book-btn ms-2">Add New Book</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Authors</th>
                        <th>Availability</th>
                        <th>Publish Date</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>
                                @if($book->borrowRecords->whereNull('return_date')->count() > 0)
                                    <span class="badge badge-checked-out">Checked out</span>
                                @else
                                    <span class="badge badge-available">Available</span>
                                @endif
                            </td>
                            <td>{{ $book->published_year }}</td>
                            <td>{{ $book->category }}</td>
                            <td><a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $books->links() }}
            </div>
        </div>
    </div>
@endsection
