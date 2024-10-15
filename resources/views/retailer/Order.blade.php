@extends('retailer.retailerD')

@section('retailer')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary mb-4">Orders List</h6>
            <a href="#" id="generateReportBtn" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate PDF Report
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

    {{-- Include jsPDF and autoTable --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Generate Report button functionality
            document.getElementById('generateReportBtn').addEventListener('click', function() {
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF();

                // Use autoTable to add the table to the PDF
                doc.autoTable({
                    html: '#dataTable', // Get the HTML table element
                    theme: 'grid', // Use grid style for the table
                    headStyles: {
                        fillColor: [22, 160, 133]
                    }, // Customize header color
                    margin: {
                        top: 10
                    } // Set top margin
                });

                // Save the PDF with a custom filename
                doc.save('orders_report.pdf');
            });
        });
    </script>
@endsection
