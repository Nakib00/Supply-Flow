@extends('admin.adminD')
@section('admin')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Product</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.Product.update', $product[0]->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product[0]->name }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" required>{{ $product[0]->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price"
                        value="{{ $product[0]->price }}" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product[0]->category == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity"
                        value="{{ $product[0]->quantity }}" required>
                </div>
                <div class="form-group">
                    <label for="image">Product Image</label>
                    <input type="file" class="form-control mb-2" id="image" name="image">
                    <img src="{{ asset('storage/' . $product[0]->image) }}" alt="{{ $product[0]->name }}" width="100">
                </div>
                <button type="submit" class="btn btn-primary">Update Product</button>
            </form>
        </div>
    </div>
@endsection
