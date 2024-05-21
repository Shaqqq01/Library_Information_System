@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Dashboard</h1>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total books</h5>
                        <p class="card-text display-4">{{ $totalBooks }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total members</h5>
                        <p class="card-text display-4">{{ $totalMembers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total checkouts</h5>
                        <p class="card-text display-4">{{ $totalCheckouts }}</p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="mb-4">Recently checked out</h2>
        <div class="card mb-4">
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Book</th>
                        <th>Member</th>
                        <th>Checked out</th>
                        <th>Due date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recentCheckouts as $checkout)
                        <tr>
                            <td>{{ $checkout->book->title }}</td>
                            <td>{{ $checkout->member->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($checkout->borrow_date)->diffForHumans() }}</td>
                            <td>{{ $checkout->return_date ? \Carbon\Carbon::parse($checkout->return_date)->diffForHumans() : 'Not Returned' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <h2 class="mb-4">Recently added books</h2>
        <div class="d-flex flex-row flex-nowrap overflow-auto">
            @foreach($recentBooks as $book)
                <div class="card mr-3" style="min-width: 200px;">
                    <div class="card-body text-center">
                        <img src="https://via.placeholder.com/150" class="card-img-top mb-2" alt="{{ $book->title }}">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">{{ $book->author }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
