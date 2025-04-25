@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <!-- Card Header -->
            <div class="card-header d-flex justify-content-start align-items-center gap-2">
                <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-sm">
                    <i class="ti ti-arrow-left"></i>
                    {{-- Back --}}
                </a>
                <h4 class="mb-0">View Role</h4>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">ID:</div>
                    <div class="col-md-9">{{ $role->id }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Name:</div>
                    <div class="col-md-9">{{ $role->name }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Permissions:</div>
                    <div class="col-md-9">
                        @if($role->permissions->isEmpty())
                            <span class="text-muted">No permissions assigned.</span>
                        @else
                            {{ $role->permissions->pluck('name')->implode(', ') }}
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Created At:</div>
                    <div class="col-md-9">{{ \Carbon\Carbon::parse($role->created_at)->format('F d, Y h:i A') }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Updated At:</div>
                    <div class="col-md-9">{{ \Carbon\Carbon::parse($role->updated_at)->format('F d, Y h:i A') }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
