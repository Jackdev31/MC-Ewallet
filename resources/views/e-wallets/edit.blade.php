@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-start align-items-center gap-2">
                        <a href="{{ route('e-wallets.index') }}" class="btn btn-secondary btn-sm">
                            <i class="ti ti-arrow-left"></i>
                            {{-- Back --}}
                        </a>
                        <h3>Update E-wallet Balance for {{ $user->name }}</h3>
                    </div>

                    <div class="card-body">
                        {{-- Display user details --}}
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Current Balance:</strong> ₱{{ number_format($user->ewallet->balance ?? 0, 2) }}</p>

                        {{-- Check if there's an e-wallet --}}
                        @if($user->ewallet)
                            {{-- Form to edit amount --}}
                            <form action="{{ route('e-wallets.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="balance">Update E-wallet Balance (₱)</label>
                                    <input type="number" name="balance" id="balance" class="form-control" 
                                           value="{{ old('balance', $user->ewallet->balance) }}" required>
                                    {{-- Display validation error --}}
                                    @error('balance')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Update E-wallet Balance</button>
                            </form>
                        @else
                            <p class="text-warning">No e-wallet found for this user.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
