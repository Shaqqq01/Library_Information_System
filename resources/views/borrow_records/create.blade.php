@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Create Borrow Record</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('borrow-records.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="book_id">Book:</label>
                                <select name="book_id" id="book_id" class="form-control">
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="member_id">Borrower:</label>
                                <select name="member_id" id="member_id" class="form-control">
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="borrow_date">Borrow Date:</label>
                                <input type="date" class="form-control" id="borrow_date" name="borrow_date">
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
