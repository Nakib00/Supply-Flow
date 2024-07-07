@extends('admin.adminD')
@section('admin')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Unit</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.unit.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Unit Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter unit name"
                        required>
                </div>
                <div class="form-group">
                    <label for="name">Description</label>
                    <input type="text" class="form-control" id="name" name="description"
                        placeholder="Enter unit Description" required>

                </div>
                <button type="submit" class="btn btn-primary">Add Unit</button>
            </form>
        </div>
    </div>
@endsection
