@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <!-- Card Header -->
            <div class="card-header d-flex justify-content-start align-items-center gap-2">
                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">
                    <i class="ti ti-arrow-left"></i>
                </a>
                <h4 class="mb-0">View User</h4>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">ID:</div>
                    <div class="col-md-9">{{ $user->id }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Name:</div>
                    <div class="col-md-9">{{ $user->name }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Email:</div>
                    <div class="col-md-9">{{ $user->email }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Roles:</div>
                    <div class="col-md-9">
                        @if($user->roles->isEmpty())
                            <span class="text-muted">No roles assigned.</span>
                        @else
                            {{ $user->roles->pluck('name')->implode(', ') }}
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Created At:</div>
                    <div class="col-md-9">{{ $user->created_at->format('F d, Y h:i A') }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 fw-bold">Updated At:</div>
                    <div class="col-md-9">{{ $user->updated_at->format('F d, Y h:i A') }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
