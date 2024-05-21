@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>Members</h1>
                    <a href="{{ route('members.create') }}" class="btn btn-primary">Add New Member</a>
                </div>
                <div class="row">
                    @foreach($members as $member)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $member->name }}</h5>
                                    <p class="card-text">
                                        <strong>IC No:</strong> {{ $member->ic_no }}<br>
                                        <strong>Address:</strong> {{ $member->address }}<br>
                                        <strong>Contact:</strong> {{ $member->contact_information }}
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('members.show', $member->id) }}" class="btn btn-outline-primary btn-sm">View</a>
                                        <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $members->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
