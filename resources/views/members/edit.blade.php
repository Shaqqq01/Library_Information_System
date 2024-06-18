@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4 text-center">Edit Member</h1>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('members.update', $member->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $member->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="ic_no">IC No</label>
                                <input type="text" class="form-control" id="ic_no" name="ic_no" value="{{ $member->ic_no }}" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ $member->address }}" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_information">Contact Information</label>
                                <input type="text" class="form-control" id="contact_information" name="contact_information" value="{{ $member->contact_information }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Member</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
