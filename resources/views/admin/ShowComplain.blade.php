@extends('admin.adminD')

@section('admin')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Complaint Details</h4>
            </div>
            <div class="card-body">
                @if ($complain->status == 1)
                    <span class="badge badge-success">Approved</span>
                @else
                    <span class="badge badge-warning">Not Approved</span>
                @endif
                <div class="form-group">
                    <label for="order_id">Order ID</label>
                    <input type="text" class="form-control" id="order_id" value="{{ $complain->order_id }}" disabled>
                </div>
                <div class="form-group">
                    <label for="quantity">Defect Product</label>
                    <input type="text" class="form-control" id="quantity" value="{{ $complain->quantity }}" disabled>
                </div>
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" value="{{ $productName }}" disabled>
                </div>
                <div class="form-group">
                    <label for="complain">Complaint Description</label>
                    <textarea class="form-control" id="complain" rows="4" disabled>{{ $complain->complain }}</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection
