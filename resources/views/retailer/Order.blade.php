@extends('retailer.retailerD')
@section('retailer')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Orders List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Total Cost</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->product }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->total }}</td>
                                <td>
                                    @if ($order->status == '1')
                                        <button class="btn btn-success" disabled>Payment Done</button>
                                    @else
                                        <a href="{{ route('retailer.checkout', $order->id) }}" class="btn btn-success">Pay
                                            Now</a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
