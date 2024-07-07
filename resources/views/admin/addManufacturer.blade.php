@extends('admin.adminD')
@section('admin')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Manufacturar</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.manufacturer.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Enter Manufacturar name" required>
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="email" class="form-control" id="name" name="email"
                        placeholder="Enter Manufacturar email" required>
                </div>
                <div class="form-group">
                    <label for="name">Password</label>
                    <input type="password" class="form-control" id="name" name="password"
                        placeholder="Enter Manufacturar password" required>
                </div>
                <div class="form-group">
                    <label for="name">Phone</label>
                    <input type="number" class="form-control" id="name" name="phone"
                        placeholder="Enter Manufacturar phone" required>
                </div>
                <div class="form-group">
                    <label for="name">Address</label>
                    <input type="text" class="form-control" id="name" name="address"
                        placeholder="Enter Manufacturar adderss" required>

                </div>
                <button type="submit" class="btn btn-primary">Add Manufacturar</button>
            </form>
        </div>
    </div>
@endsection
