@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8 mx-auto d-flex justify-content-between">
                <form id="search-form" action="{{ route('borrow-records.index') }}" method="GET" class="d-flex flex-grow-1">
                    <div class="input-group flex-grow-1">
                        <select name="search_type" class="form-control">
                            <option value="book_id" {{ request()->query('search_type') == 'book_id' ? 'selected' : '' }}>Search by Book ID</option>
                            <option value="ic_no" {{ request()->query('search_type') == 'ic_no' ? 'selected' : '' }}>Search by IC No</option>
                        </select>
                        <input type="text" name="search" class="form-control" placeholder="Search for books, movies, music, and more" value="{{ request()->query('search') }}">
                        <input type="hidden" name="tab" id="tab" value="{{ request()->query('tab', 'checkedOut') }}">
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
                        <a class="nav-link {{ request()->query('tab', 'checkedOut') == 'checkedOut' ? 'active' : '' }}" id="checkedOut-tab" data-bs-toggle="tab" href="#checkedOut" role="tab" aria-controls="checkedOut" aria-selected="true">Checked Out</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->query('tab') == 'history' ? 'active' : '' }}" id="history-tab" data-bs-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">History</a>
                    </li>
                </ul>

                <div class="tab-content mt-4">
                    <div id="checkedOut" class="tab-pane fade {{ request()->query('tab', 'checkedOut') == 'checkedOut' ? 'show active' : '' }}" role="tabpanel" aria-labelledby="checkedOut-tab">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Book ID</th>
                                <th>Title</th>
                                <th>Borrowed Date</th>
                                <th>Member Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($checkedOutRecords as $record)
                                <tr>
                                    <td>{{ $record->book->id }}</td>
                                    <td>{{ $record->book->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($record->borrow_date)->format('M d, Y') }}</td>
                                    <td>{{ $record->member->name }}</td>
                                    <td>
                                        <a href="{{ route('borrow-records.edit', $record->id) }}" class="btn btn-primary btn-sm">Edit/Return Book</a>
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
                        @if ($checkedOutRecords->hasPages())
                            <nav>
                                <ul class="pagination justify-content-center">
                                    {{-- Previous Page Link --}}
                                    @if ($checkedOutRecords->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $checkedOutRecords->previousPageUrl() }}" rel="prev">&laquo;</a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($checkedOutRecords->links()->elements[0] as $page => $url)
                                        @if ($page == $checkedOutRecords->currentPage())
                                            <li class="page-item active" aria-current="page">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($checkedOutRecords->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $checkedOutRecords->nextPageUrl() }}" rel="next">&raquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link">&raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
                    </div>

                    <div id="history" class="tab-pane fade {{ request()->query('tab') == 'history' ? 'show active' : '' }}" role="tabpanel" aria-labelledby="history-tab">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Book ID</th>
                                <th>Title</th>
                                <th>Borrowed Date</th>
                                <th>Return Date</th>
                                <th>Member Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($historyRecords as $record)
                                <tr>
                                    <td>{{ $record->book->id }}</td>
                                    <td>{{ $record->book->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($record->borrow_date)->format('M d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($record->return_date)->format('M d, Y') }}</td>
                                    <td>{{ $record->member->name }}</td>
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
                        @if ($historyRecords->hasPages())
                            <nav>
                                <ul class="pagination justify-content-center">
                                    {{-- Previous Page Link --}}
                                    @if ($historyRecords->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link">&laquo;</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $historyRecords->previousPageUrl() }}" rel="prev">&laquo;</a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($historyRecords->links()->elements[0] as $page => $url)
                                        @if ($page == $historyRecords->currentPage())
                                            <li class="page-item active" aria-current="page">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($historyRecords->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $historyRecords->nextPageUrl() }}" rel="next">&raquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link">&raquo;</span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('search-form');
            const tabInput = document.getElementById('tab');
            const tabs = document.querySelectorAll('a[data-bs-toggle="tab"]');

            tabs.forEach(tab => {
                tab.addEventListener('shown.bs.tab', function(event) {
                    tabInput.value = event.target.getAttribute('href').substring(1);
                });
            });

            const activeTab = document.querySelector('.nav-link.active');
            if (activeTab) {
                tabInput.value = activeTab.getAttribute('href').substring(1);
            }
        });
    </script>
@endsection
