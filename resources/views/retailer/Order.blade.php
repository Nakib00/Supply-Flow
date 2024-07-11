@extends('retailer.retailerD')

@section('retailer')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary mb-4">Orders List</h6>
            <a href="#" id="generateReportBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
            </a>
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

    {{--  <!-- Optional: Include xlsx library -->  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('generateReportBtn').addEventListener('click', function() {
                // Get table element
                var table = document.getElementById('dataTable');
                // Convert table to Excel sheet
                var wb = XLSX.utils.table_to_book(table, {
                    sheet: "Orders Report"
                });
                // Generate and download the Excel file
                XLSX.writeFile(wb, 'orders_report.xlsx');
            });
        });
    </script>
@endsection
