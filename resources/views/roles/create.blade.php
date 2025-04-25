@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-start align-items-center gap-2">
                <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-sm">
                    <i class="ti ti-arrow-left"></i>
                    {{-- Back --}}
                </a>
                <h3>Create Role</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Role Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <h5>Permissions</h5>
                        @foreach ($permissions as $permission)
                            <div class="form-check form-switch form-check-lg">
                                <input class="form-check-input" type="checkbox" id="permission_{{ $permission->id }}"
                                    name="permissions[]" value="{{ $permission->id }}">
                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="ti ti-shield"></i> Create Role</button>
                </form>
            </div>
        </div>
    </div>
@endsection
