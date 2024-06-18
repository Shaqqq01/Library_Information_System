@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 member-list">
                <div class="d-flex align-items-center mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search by name">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                    <a href="{{ route('members.create') }}" class="btn btn-success ms-2 add-member-btn">
                        <i class="fas fa-plus"></i>Add Member
                    </a>
                </div>
                <ul class="list-group">
                    @foreach($members as $member)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('members.show', $member->id) }}">
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
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Due Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($selectedMember->borrowRecords as $record)
                            <tr>
                                <td>{{ $record->book->title }}</td>
                                <td>{{ $record->book->author }}</td>
                                <td>{{ $record->due_date }}</td>
                                <td>
                                    @if($record->status == 'returned')
                                        <span class="badge badge-returned">Returned</span>
                                    @elseif($record->status == 'overdue')
                                        <span class="badge badge-overdue">Overdue</span>
                                    @else
                                        <span class="badge badge-not-confirmed">Not Confirmed</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <h2 class="mt-4">Fine History</h2>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Note</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($selectedMember->fines as $fine)
                            <tr>
                                <td>{{ $fine->date }}</td>
                                <td>{{ $fine->amount }}</td>
                                <td>{{ $fine->note }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Select a member to view details</p>
                @endif
            </div>
        </div>
    </div>
@endsection
