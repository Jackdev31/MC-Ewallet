@extends('layouts.app')

@push('styles')
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Card --}}
        <div class="card">
            <div
                class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                <h3 class="card-title mb-0">Products</h3>
                @can('create products')
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="ti ti-package"></i> Add Product
                    </a>
                @endcan
            </div>

            <div class="card-body">
                @if ($products->isEmpty())
                    <p>No products found.</p>
                @else
                    <div class="table-responsive">
                        <table id="products-table" class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            @if ($product->product_image)
                                                <img src="{{ asset('storage/' . $product->product_image) }}"
                                                    alt="{{ $product->name }}" width="100" height="100"
                                                    class="img-thumbnail"
                                                    onerror="this.onerror=null; this.src='{{ asset('images/default.png') }}';">
                                            @else
                                                <span class="text-muted">No image</span>
                                            @endif



                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>₱{{ number_format($product->price, 2) }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('products.show', $product->id) }}"
                                                    class="btn btn-sm btn-info" title="View">
                                                    <i class="ti ti-eye"></i>
                                                </a>

                                                @can('edit products')
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>
                                                @endcan

                                                @can('delete products')
                                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#products-table').DataTable({
                responsive: true,
                order: [
                    [1, 'asc']
                ]
            });
        });
    </script>
@endpush
