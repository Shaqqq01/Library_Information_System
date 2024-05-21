@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4 text-center">Volunteers</h1>

                <!-- Create Volunteer Link (only for supervisors) -->
                @if(auth()->user()->role === 'supervisor')
                    <div class="text-center mb-3">
                        <a href="{{ route('volunteers.create') }}" class="btn btn-primary">Add New Volunteer</a>
                    </div>
                @endif

                <div class="card-deck">
                    @foreach($volunteers as $volunteer)
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ $volunteer->name }}</h5>
                                <p class="card-text">{{ $volunteer->email }}</p>
                                <a href="{{ route('volunteers.show', $volunteer->id) }}" class="btn btn-info">Details</a>

                                <!-- Edit and Delete Links (only for supervisors) -->
                                @if(auth()->user()->role === 'supervisor')
                                    <div class="d-flex justify-content-end mt-2">
                                        <a href="{{ route('volunteers.edit', $volunteer->id) }}" class="btn btn-warning btn-sm mr-2">Edit</a>
                                        <form action="{{ route('volunteers.destroy', $volunteer->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
