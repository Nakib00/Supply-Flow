@extends('admin.adminD')
@section('admin')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Sales List</h6>
                <a href="{{ route('admin.sale.create') }}" class="btn btn-primary">Add Sale</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Retailer Name</th>
                            <th>Status</th>
                            <th>Sale Date</th>
                            <th>Paid Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td>{{ $sale->product }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>{{ $sale->total }}</td>
                                <td>{{ $sale->retailer_name }}</td>
                                <td>
                                    @if ($sale->status == 0)
                                        <span class="badge badge-warning">Not Paid</span>
                                    @elseif ($sale->status == 1)
                                        <span class="badge badge-success">Paid</span>
                                    @endif
                                </td>
                                <td>{{ $sale->sale_date }}</td>
                                <td>{{ $sale->paid_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
