@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 member-list">
                <form method="GET" action="{{ route('members.index') }}" class="d-flex align-items-center mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                    <a href="{{ route('members.create') }}" class="btn btn-success ms-2 add-member-btn">
                        <i class="fas fa-plus"></i> Add Member
                    </a>
                </form>
                <ul class="list-group">
                    @foreach($members as $member)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('members.show', ['member' => $member->id, 'search' => request('search')]) }}">
                                <h5>{{ $member->name }}</h5>
                            </a>
                            <div class="dropdown">
                                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton{{ $member->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $member->id }}">
                                    <li><a class="dropdown-item" href="{{ route('members.edit', $member->id) }}">Edit</a></li>
                                    <li><a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this member?')) { document.getElementById('delete-member-form-{{ $member->id }}').submit(); }">Delete</a></li>
                                </ul>
                            </div>
                            <form id="delete-member-form-{{ $member->id }}" action="{{ route('members.destroy', $member->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-8 member-details">
                @if(isset($selectedMember))
                    <h1>{{ $selectedMember->name }}</h1>
                    <div class="detail-item"><span>Contact Information:</span> {{ $selectedMember->contact_information }}</div>
                    <div class="detail-item"><span>IC No:</span> {{ $selectedMember->ic_no }}</div>
                    <div class="detail-item"><span>Address:</span> {{ $selectedMember->address }}</div>

                    <h2 class="mt-4">Borrowing History</h2>
                    <table class="table">
                        <thead class="table-header-gray">
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Borrowing Date</th>
                            <th>Return Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($borrowRecords as $record)
                            <tr>
                                <td>{{ $record->book->title }}</td>
                                <td>{{ $record->book->author }}</td>
                                <td>{{ \Carbon\Carbon::parse($record->borrow_date)->format('M d, Y') }}</td>
                                <td class="{{ $record->return_date ? '' : 'greyed-out-text' }}">{{ $record->return_date ?? 'Not Confirmed' }}</td>
                                <td>
                                    @if($record->return_date)
                                        <span class="badge badge-returned">Returned</span>
                                    @else
                                        <span class="badge badge-checked-out">Checked Out</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $borrowRecords->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
                    </div>
                @else
                    <p>Select a member to view details</p>
                @endif
            </div>
        </div>
    </div>
@endsection
