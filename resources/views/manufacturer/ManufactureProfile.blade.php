@extends('manufacturer.manufacturerD')

@section('manufacturer')
    <div class="card">
        <div class="card-header">
            <h4>Manufacturer Profile</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('manufacturer.profile.update') }}" method="POST" class="mb-4">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $manufacturer[0]->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email', $manufacturer[0]->email) }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ old('phone', $manufacturer[0]->phone) }}" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ old('address', $manufacturer[0]->address) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
@endsection
