@extends('admin.adminD')
@section('admin')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Area</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.area.update', $area[0]->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Area Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $area[0]->name }}"
                        placeholder="Enter area name" required>
                </div>
                <div class="form-group">
                    <label for="name">Area Code</label>
                    <input type="text" class="form-control" id="name" name="code" value="{{ $area[0]->code }}"
                        placeholder="Enter area code" required>
                </div>
                <div class="form-group">
                    <label for="name">Area Description</label>
                    <input type="text" class="form-control" id="name" name="description"
                        value="{{ $area[0]->description }}" placeholder="Enter area description" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Area</button>
            </form>
        </div>
    </div>
@endsection
