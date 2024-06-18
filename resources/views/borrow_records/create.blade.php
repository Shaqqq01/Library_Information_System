@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Borrow a Book') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('borrow-records.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="book_id" class="form-label">Book</label>
                                <select id="book_id" name="book_id" class="form-control" required>
                                    <option value="">Select a book</option>
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="member_id" class="form-label">Member</label>
                                <select id="member_id" name="member_id" class="form-control" required>
                                    <option value="">Select a member</option>
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="borrow_date" class="form-label">Borrow Date</label>
                                <input type="date" id="borrow_date" name="borrow_date" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Borrow</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
