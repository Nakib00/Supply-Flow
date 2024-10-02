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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>

    {{--  <!-- Optional: Include xlsx library -->  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('generateReportBtn').addEventListener('click', function() {
                // Import jsPDF
                const {
                    jsPDF
                } = window.jspdf;

                // Create a new instance of jsPDF
                const doc = new jsPDF();

                // Get the table data from the DOM
                const table = document.getElementById('dataTable');

                // Convert the table into a PDF using autoTable
                doc.autoTable({
                    html: table, // Use the HTML table directly
                    theme: 'grid', // Optional, style the table with grid theme
                    headStyles: {
                        fillColor: [0, 123, 255]
                    }, // Customize header color to match your design
                    margin: {
                        top: 20
                    }, // Add margin at the top
                    styles: {
                        fontSize: 10, // Adjust font size to fit content
                    }
                });

                // Save the PDF
                doc.save('sales_report.pdf');
            });
        });
    </script>
@endsection
