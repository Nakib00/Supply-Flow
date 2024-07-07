@extends('admin.adminD')
@section('admin')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Unit</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.unit.update', $unit[0]->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Unit Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $unit[0]->name }}"
                        placeholder="Enter unit name" required>
                </div>
                <div class="form-group">
                    <label for="name">Unit Description</label>
                    <input type="text" class="form-control" id="name" name="description"
                        value="{{ $unit[0]->description }}" placeholder="Enter unit description" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Unit</button>
            </form>
        </div>
    </div>
@endsection
