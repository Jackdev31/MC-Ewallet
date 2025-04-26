@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-start align-items-center gap-2">
                <a href="{{ route('e-wallets.index') }}" class="btn btn-secondary btn-sm">
                    <i class="ti ti-arrow-left"></i>
                    {{-- Back --}}
                </a>
                <h3 class="mb-0">Load Credits to {{ $user->name }}'s E-wallet</h3>
            </div>

            <div class="card-body">
                {{-- Display user details --}}
                <div class="mb-4">
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Current Balance:</strong> ₱{{ number_format($user->ewallet->balance ?? 0, 2) }}</p>
                </div>

                {{-- Predefined amounts card --}}
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Quick Load Amounts</h5>
                        <div class="row g-2">
                            @foreach ([20, 30, 50, 80, 100, 150, 200, 250, 300, 350, 400, 500, 800, 1000] as $amount)
                                <div class="col-4 col-md-2">
                                    <button type="button"
                                        class="btn btn-light w-100 border shadow-sm py-3 fw-bold bg-yellow-300"
                                        onclick="document.getElementById('amount').value='{{ $amount }}'">
                                        ₱{{ number_format($amount, 0) }}
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Form to load amount --}}
                <form action="{{ route('e-wallets.storeCredits', $user->id) }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="amount" class="form-label">Amount to Load (₱)</label>
                        <input type="number" name="amount" id="amount" class="form-control form-control-md" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md">
                        <i class="ti ti-wallet"></i> Load E-wallet
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
