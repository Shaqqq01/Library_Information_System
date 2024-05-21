@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Edit Borrow Record</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('borrow-records.update', $borrowRecord->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="book_id">Book:</label>
                                <select name="book_id" id="book_id" class="form-control">
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}" {{ $borrowRecord->book_id == $book->id ? 'selected' : '' }}>{{ $book->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="member_id">Borrower:</label>
                                <select name="member_id" id="member_id" class="form-control">
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}" {{ $borrowRecord->member_id == $member->id ? 'selected' : '' }}>{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="borrow_date">Borrow Date:</label>
                                <input type="date" class="form-control" id="borrow_date" name="borrow_date" value="{{ $borrowRecord->borrow_date }}">
                            </div>
                            <div class="form-group">
                                <label for="return_date">Return Date:</label>
                                <input type="date" class="form-control" id="return_date" name="return_date" value="{{ $borrowRecord->return_date }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
