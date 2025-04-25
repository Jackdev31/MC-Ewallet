@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <!-- Card Header with Title -->
            <div class="card-header d-flex justify-content-start align-items-center gap-2">
                <a href="{{ route('permissions.index') }}" class="btn btn-secondary btn-sm">
                    <i class="ti ti-arrow-left"></i>
                    {{-- Back --}}
                </a>
                <h4 class="card-title mb-0">Edit Permission</h4>
            </div>

            <div class="card-body">
                <!-- Form to Edit Permission -->
                <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Permission Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $permission->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="ti ti-pencil"></i> Update Permission
                    </button>                    
                    <a href="{{ route('permissions.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
