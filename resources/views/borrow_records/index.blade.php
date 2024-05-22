@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8 mx-auto d-flex justify-content-between">
                <form action="{{ route('borrow-records.index') }}" method="GET" class="d-flex flex-grow-1">
                    <div class="input-group flex-grow-1">
                        <select name="search_type" class="form-control">
                            <option value="book_id">Search by Book ID</option>
                            <option value="ic_no">Search by IC No</option>
                        </select>
                        <input type="text" name="search" class="form-control" placeholder="Search for books, movies, music, and more" value="{{ request()->query('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('borrow-records.create') }}" class="btn btn-success add-book-btn ms-2">Add New Borrow Record</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="checkedOut-tab" data-bs-toggle="tab" href="#checkedOut" role="tab" aria-controls="checkedOut" aria-selected="true">Checked Out</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="history-tab" data-bs-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">History</a>
                    </li>
                </ul>

                <div class="tab-content mt-4">
                    <div id="checkedOut" class="tab-pane fade show active" role="tabpanel" aria-labelledby="checkedOut-tab">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Due Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($checkedOutRecords as $record)
                                <tr>
                                    <td>{{ $record->book->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($record->due_date)->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('borrow-records.edit', $record->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('borrow-records.destroy', $record->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $checkedOutRecords->links() }}
                    </div>

                    <div id="history" class="tab-pane fade" role="tabpanel" aria-labelledby="history-tab">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Due Date</th>
                                <th>Return Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($historyRecords as $record)
                                <tr>
                                    <td>{{ $record->book->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($record->due_date)->format('M d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($record->return_date)->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('borrow-records.edit', $record->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('borrow-records.destroy', $record->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $historyRecords->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
