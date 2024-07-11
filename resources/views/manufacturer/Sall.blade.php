@extends('manufacturer.manufacturerD')

@section('manufacturer')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Orders List</h6>
                <a href="#" id="generateReportBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->order_id }}</td>
                                <td>{{ $order->product_name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->tax }}</td>
                                <td>{{ $order->total }}</td>
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
                                <td>
                                    <select class="form-control status-dropdown" data-order-id="{{ $order->order_id }}">
                                        <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Not Approved
                                        </option>
                                        <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Approved
                                        </option>
                                        <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Delivered
                                        </option>
                                    </select>
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
            // Generate Report button functionality
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

            // Status dropdowns functionality
            const statusDropdowns = document.querySelectorAll('.status-dropdown');

            statusDropdowns.forEach(dropdown => {
                dropdown.addEventListener('change', function() {
                    const orderId = this.getAttribute('data-order-id');
                    const status = this.value;

                    fetch("{{ route('manufacturer.updateOrderStatus') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                order_id: orderId,
                                status: status
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload(); // Reload the page to show updated status
                            } else {
                                alert('Failed to update status');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
@endsection
