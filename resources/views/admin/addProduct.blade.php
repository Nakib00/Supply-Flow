@extends('admin.adminD')
@section('admin')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.Product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name"
                        required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Enter Product Description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price"
                        placeholder="Enter Product Price" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-control" id="category_id" name="category" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity"
                        placeholder="Enter Product Quantity" required>
                </div>
                <div class="form-group">
                    <label for="image">Product Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>
@endsection
