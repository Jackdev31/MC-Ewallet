@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <!-- Card Header -->
            <div class="card-header d-flex justify-content-start align-items-center gap-2">
                <a href="{{ route('product-categories.index') }}" class="btn btn-secondary btn-sm">
                    <i class="ti ti-arrow-left"></i>
                    {{-- Back --}}
                </a>
                <h4 class="mb-0">Edit Product Category</h4>
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

                <form action="{{ route('product-categories.update', $productCategory->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $productCategory->name) }}" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="ti ti-edit"></i> Update Category
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
