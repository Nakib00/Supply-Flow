@extends('admin.adminD')

@section('admin')
    <div class="card-body">
        <form action="{{ route('admin.retailer.update', $retailer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $retailer->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $retailer->email }}"
                    required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ $retailer->password }}"
                    required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="number" class="form-control" id="phone" name="phone" value="{{ $retailer->phone }}"
                    required>
            </div>
            <div class="form-group">
                <label for="area_id">Area Code</label>
                <select class="form-control" id="area_id" name="area_id" required>
                    <option value="">Select Area Code</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{ $retailer->area_id == $area->id ? 'selected' : '' }}>
                            {{ $area->name }} ({{ $area->code }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $retailer->address }}"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Update Retailer</button>
        </form>
    </div>
@endsection
