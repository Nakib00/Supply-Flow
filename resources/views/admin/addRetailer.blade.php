@extends('admin.adminD')
@section('admin')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Retailer</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.retailer.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Retailer name"
                        required>
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="email" class="form-control" id="name" name="email"
                        placeholder="Enter Retailer email" required>
                </div>
                <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" class="form-control" id="name" name="password"
                        placeholder="Enter Retailer password" required>
                </div>
                <div class="form-group">
                    <label for="name">Phone</label>
                    <input type="number" class="form-control" id="name" name="phone"
                        placeholder="Enter Retailer phone" required>
                </div>
                <div class="form-group">
                    <label for="area_id">Area Code</label>
                    <select class="form-control" id="area_id" name="area_id" required>
                        <option value="">Select Area Code</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }} ({{ $area->code }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Address</label>
                    <input type="text" class="form-control" id="name" name="address"
                        placeholder="Enter Retailer adderss" required>

                </div>
                <button type="submit" class="btn btn-primary">Add Retailer</button>
            </form>
        </div>
    </div>
@endsection
