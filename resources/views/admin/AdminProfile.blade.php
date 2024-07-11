@extends('admin.adminD')

@section('admin')
    <div class="card">
        <div class="card-header">
            <h4>Admin Profile</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.profile.update') }}" method="POST" class="mb-4">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $admin[0]->name }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $admin[0]->email }}"
                        required>
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
@endsection
