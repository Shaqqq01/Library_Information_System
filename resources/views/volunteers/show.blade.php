@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Volunteer Details</h2>
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $volunteer->name }}</p>
                        <p><strong>Email:</strong> {{ $volunteer->email }}</p>
                        <a href="{{ route('volunteers.edit', $volunteer->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
