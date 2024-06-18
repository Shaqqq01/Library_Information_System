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

        <h2 class="mb-4">Activities this month</h2>
        <div class="card mb-4">
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Book</th>
                        <th>Member</th>
                        <th>Checked out</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recentCheckouts as $checkout)
                        <tr>
                            <td>{{ $checkout->book->title }}</td>
                            <td>{{ $checkout->member->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($checkout->borrow_date)->format('M d, Y') }}</td>
                            <td>
                                @if($checkout->return_date)
                                    <span class="badge badge-returned">Returned</span>
                                @else
                                    <span class="badge badge-checked-out">Checked Out</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if ($recentCheckouts->hasPages())
                    <nav>
                        <ul class="pagination justify-content-center">
                            {{-- Previous Page Link --}}
                            @if ($recentCheckouts->onFirstPage())
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $recentCheckouts->previousPageUrl() }}" rel="prev">&laquo;</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($recentCheckouts->links()->elements[0] as $page => $url)
                                @if ($page == $recentCheckouts->currentPage())
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
                            @if ($recentCheckouts->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $recentCheckouts->nextPageUrl() }}" rel="next">&raquo;</a>
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
@endsection
