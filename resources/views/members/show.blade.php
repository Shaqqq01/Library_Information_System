@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4 text-center">Volunteer Details</h1>
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">{{ $volunteer->name }}</h2>
                        <p><strong>Email:</strong> {{ $volunteer->email }}</p>
                        <a href="{{ route('volunteers.edit', $volunteer->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
