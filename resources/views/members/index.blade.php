@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-4 member-list">
                <div class="search-bar input-group">
                    <input type="text" class="form-control" placeholder="Search by name">
                    <button class="btn btn-primary">Search</button>
                </div>
                <ul class="list-group">
                    @foreach($members as $member)
                        <a href="{{ route('members.show', $member->id) }}" class="list-group-item list-group-item-action">
                            <div>
                                <h5>{{ $member->name }}</h5>
                            </div>
                        </a>
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
