@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4 text-center">Borrow Records</h1>
                <form action="{{ route('borrow-records.index') }}" method="GET" class="mb-4">
                    <div class="form-group">
                        <label for="search_criteria">Search By:</label>
                        <select name="search_criteria" id="search_criteria" class="form-control">
                            <option value="book_id">Book ID</option>
                            <option value="ic_no">Borrower's IC No.</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request()->query('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
                <div class="text-center mb-3">
                    <a href="{{ route('borrow-records.create') }}" class="btn btn-success">Add New Borrow Record</a>
                </div>
                <div class="card-deck">
                    @foreach($borrowRecords as $record)
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Book: {{ $record->book->title }}</h5>
                                <p class="card-text"><strong>Borrower:</strong> {{ $record->member->name }}</p>
                                <p class="card-text"><strong>Borrow Date:</strong> {{ $record->borrow_date }}</p>
                                <p class="card-text"><strong>Return Date:</strong> {{ $record->return_date ?? 'Not Returned' }}</p>
                                <a href="{{ route('borrow-records.edit', $record->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $borrowRecords->links() }}
            </div>
        </div>
    </div>
@endsection
