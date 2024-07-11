@extends('admin.adminD')

@section('admin')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Quality Check</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Manufacturer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td><a
                                        href="{{ route('admin.orders.complain', $order->id) }}">{{ $order->product_name }}</a>
                                </td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->total }}</td>
                                <td>{{ $order->manufacturer_name }}</td>

                                <td>
                                    @php
                                        $complainExists = DB::table('complains')
                                            ->where('order_id', $order->id)
                                            ->exists();
                                    @endphp

                                    @if ($complainExists)
                                        <a href="{{ route('orders.complainDetails', $order->id) }}"
                                            class="btn btn-sm btn-info">View Complain</a>
                                    @else
                                        <button class="btn btn-sm btn-secondary" disabled>Not Applied Yet</button>
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
