@extends('admin.adminD')
@section('admin')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Sales List</h6>
                <a href="#" id="generateReportBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                </a>
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
                                        <span class="badge badge-success" data-toggle="modal"
                                            data-target="#paymentModal{{ $sale->id }}">Paid</span>
                                        <!-- Payment Modal -->
                                        <div class="modal fade" id="paymentModal{{ $sale->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="paymentModalLabel{{ $sale->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="paymentModalLabel{{ $sale->id }}">
                                                            Payment Information</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Display payment information -->
                                                        @if ($sale->payment_type == 1 || $sale->payment_type == 2)
                                                            <p><strong>Payment Type:</strong>
                                                                {{ $sale->payment_type == 1 ? 'Credit Card' : 'Debit Card' }}
                                                            </p>
                                                            <p><strong>Card Number:</strong> {{ $sale->card_number }}</p>
                                                            <p><strong>Expiration Date:</strong>
                                                                {{ $sale->expiration_date }}</p>
                                                            <p><strong>CVV:</strong> {{ $sale->cvv }}</p>
                                                        @elseif ($sale->payment_type == 4 || $sale->payment_type == 5)
                                                            <p><strong>Payment Type:</strong>
                                                                {{ $sale->payment_type == 4 ? 'Bkash' : 'Nagad' }}</p>
                                                            <p><strong>Mobile Number:</strong> {{ $sale->mobile_number }}
                                                            </p>
                                                            <p><strong>Transaction ID:</strong> {{ $sale->Transaction_ID }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

    {{--  <!-- Optional: Include xlsx library -->  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('generateReportBtn').addEventListener('click', function() {
                // Get table element
                var table = document.getElementById('dataTable');
                // Convert table to Excel sheet
                var wb = XLSX.utils.table_to_book(table, {
                    sheet: "Sales Report"
                });
                // Generate and download the Excel file
                XLSX.writeFile(wb, 'sales_report.xlsx');
            });
        });
    </script>
@endsection
