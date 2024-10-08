@extends('admin.adminD')

@section('admin')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Distributor List</h6>
                <a href="{{ route('admin.distributer.create') }}" class="btn btn-primary">Add Distributor</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Company Name</th>
                            <th>Address</th>
                            <th>NID</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($distributors as $distributor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $distributor->name }}</td>
                                <td>{{ $distributor->phone }}</td>
                                <td>{{ $distributor->company_name }}</td>
                                <td>{{ $distributor->address }}</td>
                                <td>{{ $distributor->nid }}</td>
                                <td>
                                    <a href="{{ route('admin.distributer.edit', $distributor->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.distributer.destroy', $distributor->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
