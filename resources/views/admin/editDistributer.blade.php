@extends('admin.adminD')
@section('admin')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Distributor</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.distributer.update', $distributer[0]->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $distributer[0]->name }}"
                        placeholder="Enter Distributor Name" required>
                </div>
                <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name"
                        value="{{ $distributer[0]->company_name }}" placeholder="Enter Company Name" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ $distributer[0]->address }}" placeholder="Enter Address" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ $distributer[0]->phone }}" placeholder="Enter Phone Number" required>
                </div>
                <div class="form-group">
                    <label for="nid">NID</label>
                    <input type="text" class="form-control" id="nid" name="nid" value="{{ $distributer[0]->nid }}"
                        placeholder="Enter NID" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Distributor</button>
            </form>
        </div>
    </div>
@endsection
