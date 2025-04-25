@extends('layouts.app')

@push('styles')
    <!-- DataTables CSS -->
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
        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if (session('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('danger') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Card --}}
        <div class="card">
            <div
                class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                <h3 class="card-title mb-0">Product Categories</h3>
                @can('create product category')
                    <a href="{{ route('product-categories.create') }}" class="btn btn-primary">
                        <i class="ti ti-package"></i> Create Category
                    </a>
                @endcan
            </div>

            <div class="card-body">
                @if ($categories->isEmpty())
                    <p>No product categories found.</p>
                @else
                    <div class="table-responsive">
                        <table id="categories-table" class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at->format('M d, Y') }}</td>
                                        <td>{{ $category->updated_at->format('M d, Y') }}</td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('product-categories.show', $category->id) }}"
                                                    class="btn btn-sm btn-info" title="View">
                                                    <i class="ti ti-eye"></i>
                                                </a>

                                                @can('edit product category')
                                                    <a href="{{ route('product-categories.edit', $category->id) }}"
                                                        class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>
                                                @endcan

                                                @can('delete product category')
                                                    <form action="{{ route('product-categories.destroy', $category->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this category?');">
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
    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#categories-table').DataTable({
                responsive: true,
                order: [
                    [0, 'asc']
                ]
            });
        });
    </script>
@endpush
