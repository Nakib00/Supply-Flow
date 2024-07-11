@extends('admin.adminD')
@section('admin')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Complain about Defect Product</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.submitComplaint', $order->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $order->product_id }}">
                    <input type="hidden" name="manufacturer_id" value="{{ $order->manufacturer_id }}">
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="product_name" value="{{ $order->product_name }}"
                            disabled>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity"
                            value="{{ old('quantity') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="complain">Complain Description</label>
                        <textarea class="form-control" id="complain" name="complain" rows="4" required>{{ old('complain') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Complaint</button>
                </form>
            </div>
        </div>
    </div>
@endsection
