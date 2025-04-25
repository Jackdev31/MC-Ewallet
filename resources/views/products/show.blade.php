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
                <h4 class="mb-0">View Product</h4>
            </div>

            {{-- Card Body --}}
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">ID:</div>
                    <div class="col-md-9">{{ $product->id }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Name:</div>
                    <div class="col-md-9">{{ $product->name }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Price:</div>
                    <div class="col-md-9">₱{{ number_format($product->price, 2) }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Quantity:</div>
                    <div class="col-md-9">{{ $product->quantity }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Category:</div>
                    <div class="col-md-9">
                        {{-- Check if the product has a category --}}
                        @if ($product->category)
                            <p>{{ $product->category->name }}</p>
                        @else
                            <span class="text-muted">No category assigned</span>
                        @endif
                    </div>
                </div>



                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Image:</div>
                    <div class="col-md-9">
                        @if ($product->product_image)
                            <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->name }}"
                                width="250" height="250" class="img-thumbnail"
                                onerror="this.onerror=null; this.src='{{ asset('images/default.png') }}';">
                        @else
                            <span class="text-muted">No image</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Created At:</div>
                    <div class="col-md-9">{{ \Carbon\Carbon::parse($product->created_at)->format('F d, Y h:i A') }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Updated At:</div>
                    <div class="col-md-9">{{ \Carbon\Carbon::parse($product->updated_at)->format('F d, Y h:i A') }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
