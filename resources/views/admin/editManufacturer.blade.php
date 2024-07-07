@extends('admin.adminD')
@section('admin')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Manufacturer</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.manufacturer.update', $manufacturer[0]->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Manufacturer Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ $manufacturer[0]->name }}" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                    <label for="name">Manufacturer Email</label>
                    <input type="email" class="form-control" id="name" name="email"
                        value="{{ $manufacturer[0]->email }}" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="name">Manufacturer Phone</label>
                    <input type="number" class="form-control" id="name" name="phone"
                        value="{{ $manufacturer[0]->phone }}" placeholder="Enter phone" required>
                </div>
                <div class="form-group">
                    <label for="name">Manufacturer Password</label>
                    <input type="password" class="form-control" id="name" name="passowrd"
                        value="{{ $manufacturer[0]->password }}" placeholder="Enter password" required>
                </div>
                <div class="form-group">
                    <label for="name">Manufacturer Address</label>
                    <input type="text" class="form-control" id="name" name="address"
                        value="{{ $manufacturer[0]->address }}" placeholder="Enter adress" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Manufacturer</button>
            </form>
        </div>
    </div>
@endsection
