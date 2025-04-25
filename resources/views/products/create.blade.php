@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <!-- Card Header -->
            <div class="card-header d-flex justify-content-start align-items-center gap-2">
                <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">
                    <i class="ti ti-arrow-left"></i>
                </a>
                <h4 class="mb-0">Add Product</h4>
            </div>

            <!-- Card Body with Form -->
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="product_category_id" class="form-label">Category</label>
                        <select name="product_category_id" id="product_category_id" class="form-select" required>
                            <option value="" disabled selected>Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="e.g. Sky Flakes" value="{{ old('name') }}" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description (optional)</label>
                        <textarea name="description" id="description" rows="3" class="form-control"
                            placeholder="Product description...">{{ old('description') }}</textarea>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price (₱)</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control"
                            placeholder="e.g. 10" value="{{ old('price') }}" required>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="product_image" class="form-label">Product Image</label>
                        <input type="file" name="product_image" id="product_image" class="form-control"
                            placeholder="Upload an image of the product">
                    </div>

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" placeholder="e.g. 10"
                            value="{{ old('quantity', 0) }}" required>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="available" {{ old('status') === 'available' ? 'selected' : '' }}>Available
                            </option>
                            <option value="not available" {{ old('status') === 'not available' ? 'selected' : '' }}>Not
                                Available</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">
                        <i class="ti ti-plus"></i> Add Product
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
