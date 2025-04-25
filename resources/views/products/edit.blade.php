@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            {{-- Card Header --}}
            <div class="card-header d-flex justify-content-start align-items-center gap-2">
                <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">
                    <i class="ti ti-arrow-left"></i>
                    {{-- Back --}}
                </a>
                <h4 class="mb-0">Edit Product</h4>
            </div>

            {{-- Card Body --}}
            <div class="card-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">ID:</div>
                        <div class="col-md-9">{{ $product->id }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Name:</div>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $product->name) }}">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Price:</div>
                        <div class="col-md-9">
                            <input type="number" name="price" step="0.01"
                                class="form-control @error('price') is-invalid @enderror"
                                value="{{ old('price', $product->price) }}">
                            @error('price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Quantity:</div>
                        <div class="col-md-9">
                            <input type="number" name="quantity"
                                class="form-control @error('quantity') is-invalid @enderror"
                                value="{{ old('quantity', $product->quantity) }}">
                            @error('quantity')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Category:</div>
                        <div class="col-md-9">
                            <select name="product_category_id"
                                class="form-control @error('product_category_id') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == old('product_category_id', $product->product_category_id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('product_category_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Product Image:</div>
                        <div class="col-md-9">
                            @if ($product->product_image)
                                <img src="{{ asset('storage/' . $product->product_image) }}" 
                                     alt="{{ $product->name }}" 
                                     width="100" 
                                     height="100" 
                                     class="img-thumbnail" 
                                     onerror="this.onerror=null; this.src='{{ asset('images/default.png') }}';">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                            <input type="file" name="product_image" class="form-control @error('product_image') is-invalid @enderror">
                            @error('product_image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    


                    <div class="row mb-3">
                        <div class="col-md-3 fw-bold">Description:</div>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
