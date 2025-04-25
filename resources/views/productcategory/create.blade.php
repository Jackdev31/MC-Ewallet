@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <!-- Card Header -->
            <div class="card-header d-flex justify-content-start align-items-center gap-2">
                <a href="{{ route('product-categories.index') }}" class="btn btn-secondary btn-sm">
                    <i class="ti ti-arrow-left"></i> Back
                </a>
                <h4 class="card-title mb-0">Create Product Category</h4>
            </div>

            <!-- Card Body with Form -->
            <div class="card-body">
                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('product-categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            required
                            placeholder="Enter category name">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-folder"></i> Create Category
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
