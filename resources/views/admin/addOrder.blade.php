@extends('admin.adminD')
@section('admin')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Order</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.order.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="manufacturer_id">Manufacturer</label>
                    <select class="form-control" id="manufacturer_id" name="manufacturer_id" required>
                        <option value="">Select Manufacturer</option>
                        @foreach ($manufacturers as $manufacturer)
                            <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="product_id">Product</label>
                    <select class="form-control" id="product_id" name="product_id" required>
                        <option value="">Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" required>
                </div>
                <div class="form-group">
                    <label for="quarry">Query</label>
                    <textarea class="form-control" id="quarry" name="quarry" required></textarea>
                </div>
                <input type="hidden" id="total" name="total">
                <input type="hidden" id="status" name="status" value="0">
                <button type="submit" class="btn btn-primary">Add Order</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('quantity').addEventListener('input', calculateTotal);
        document.getElementById('product_id').addEventListener('change', calculateTotal);

        function calculateTotal() {
            const productSelect = document.getElementById('product_id');
            const selectedProduct = productSelect.options[productSelect.selectedIndex];
            const price = parseFloat(selectedProduct.getAttribute('data-price')) || 0;
            const quantity = parseInt(document.getElementById('quantity').value) || 0;
            const total = price * quantity;
            document.getElementById('total').value = total.toFixed(2); 
        }
    </script>
@endsection
