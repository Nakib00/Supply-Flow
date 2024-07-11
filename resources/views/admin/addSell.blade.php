@extends('admin.adminD')
@section('admin')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Sale</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sales.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="product_id">Product Name</label>
                    <select class="form-control" id="product_id" name="product_id">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" required>
                </div>
                <div class="form-group">
                    <label for="retailer_id">Retailer Name</label>
                    <select class="form-control" id="retailer_id" name="retailer_id">
                        @foreach ($retailers as $retailer)
                            <option value="{{ $retailer->id }}">{{ $retailer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Sale</button>
            </form>
        </div>
    </div>
@endsection
