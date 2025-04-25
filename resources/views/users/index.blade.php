@extends('layouts.app')

@section('content')
    <div class="container py-4">
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
                <h3 class="card-title mb-0">Users</h3>
                @can('create user')
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="ti ti-user-plus fs-6"></i> Create User
                    </a>
                @endcan
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="users-table" class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->roles->isNotEmpty())
                                            @foreach ($user->roles as $role)
                                                <span class="badge bg-secondary">{{ $role->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">No roles</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->updated_at)->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group">
                                            @can('view users')
                                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info"
                                                    title="View">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                            @endcan
                                            @can('edit users')
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning"
                                                    title="Edit">
                                                    <i class="ti ti-pencil"></i>
                                                </a>
                                            @endcan
                                            @can('delete users')
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
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
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                responsive: true,
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                    targets: -1,
                    orderable: false
                }]
            });
        });
    </script>
@endpush
