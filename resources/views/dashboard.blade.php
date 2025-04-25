@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col">
            <h2 class="h4 font-weight-bold text-dark">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </div>

    <!-- Dashboard Content -->
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-light">
                <div class="card-body text-center">
                    <div class="fs-4 text-success mb-3">
                        <i class="bi bi-check-circle"></i> {{ __("You're logged in!") }}
                    </div>
                    <div class="text-muted">
                        Welcome {{Auth::user()->name}}!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
