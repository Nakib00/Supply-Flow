@extends('manufacturer.manufacturerD')

@section('manufacturer')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Complain Check</h6>
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
                            <th>Complain</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($complains as $complain)
                            <tr>
                                <td>{{ $complain->order_id }}</td>
                                <td>{{ $complain->product_name }}</td>
                                <td>{{ $complain->quantity }}</td>
                                <td>{{ $complain->complain }}</td>
                                <td>
                                    @if ($complain->status == 1)
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-warning">Not Approved</span>
                                    @endif
                                </td>
                                <td>
                                    <select class="form-control status-dropdown" data-order-id="{{ $complain->order_id }}">
                                        <option value="0" {{ $complain->status == 0 ? 'selected' : '' }}>Not Approved
                                        </option>
                                        <option value="1" {{ $complain->status == 1 ? 'selected' : '' }}>Approved
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusDropdowns = document.querySelectorAll('.status-dropdown');

            statusDropdowns.forEach(dropdown => {
                dropdown.addEventListener('change', function() {
                    const orderId = this.getAttribute('data-order-id');
                    const status = this.value;

                    fetch("{{ route('complain.update-status') }}", {
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
