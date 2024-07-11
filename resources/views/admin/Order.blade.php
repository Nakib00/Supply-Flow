@extends('admin.adminD')

@section('admin')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Order List</h6>
                <a href="#" id="generateReportBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                </a>
                <a href="{{ route('admin.order.create') }}" class="btn btn-primary">Add Order</a>
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
                            <th>Tax</th>
                            <th>Manufacturer</th>
                            <th>Order Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->product_name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->total }}</td>
                                <td>{{ $order->tax }}</td>
                                <td>{{ $order->manufacturer_name }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    @if ($order->status == 0)
                                        <span class="badge badge-warning">Not Approved</span>
                                    @elseif ($order->status == 1)
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-success">Delivered</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--  <!-- Optional: Include xlsx library -->  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('generateReportBtn').addEventListener('click', function() {
                // Get table element
                var table = document.getElementById('dataTable');
                // Convert table to Excel sheet
                var wb = XLSX.utils.table_to_book(table, {
                    sheet: "Order Report"
                });
                // Generate and download the Excel file
                XLSX.writeFile(wb, 'order_report.xlsx');
            });
        });
    </script>
@endsection
