@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8 mx-auto d-flex justify-content-between">
                <form action="{{ route('volunteers.index') }}" method="GET" class="d-flex flex-grow-1">
                    <div class="input-group flex-grow-1">
                        <select name="search_type" class="form-control">
                            <option value="name">Search by Name</option>
                            <option value="email">Search by Email</option>
                        </select>
                        <input type="text" name="search" class="form-control" placeholder="Search for volunteers" value="{{ request()->query('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                <div class="tab-content mt-4">
                    <div id="volunteers" class="tab-pane fade show active" role="tabpanel" aria-labelledby="volunteers-tab">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($volunteers as $volunteer)
                                <tr>
                                    <td>{{ $volunteer->name }}</td>
                                    <td>{{ $volunteer->email }}</td>
                                    <td>
                                        <a href="{{ route('volunteers.edit', $volunteer->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('volunteers.destroy', $volunteer->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $volunteers->links() }}
                    </div>

                    <div id="coordinators" class="tab-pane fade" role="tabpanel" aria-labelledby="coordinators-tab">
                        <!-- Coordinator content can go here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
