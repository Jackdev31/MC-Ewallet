@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            {{-- E-wallet Overview --}}
            <div class="col-md-12">
                <h4>E-wallet Overview</h4>

                {{-- Table displaying user details and e-wallet information --}}
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>E-wallet Balance</th>
                            @can('load e-wallets')
                            <th class="text-center">Actions</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>

                                {{-- Display the e-wallet balance or a message if no e-wallet exists --}}
                                <td>
                                    @if ($user->ewallet)
                                        ₱{{ number_format($user->ewallet->balance, 2) }}
                                    @else
                                        E-wallet not Loaded
                                    @endif
                                </td>

                                {{-- Action Icons --}}
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Actions">
                                        {{-- Load Button --}}
                                        @can('load e-wallets')
                                        <a href="{{ route('e-wallets.load', $user->id) }}" class="btn btn-sm btn-primary"
                                            title="Load">
                                            <i class="ti ti-wallet"></i>
                                        </a>
                                        @endcan
                                        {{-- Edit Button --}}
                                        @can('edit e-wallets')
                                        <a href="{{ route('e-wallets.edit', $user->id) }}" class="btn btn-sm btn-warning"
                                            title="Edit">
                                            <i class="ti ti-pencil"></i>
                                        </a>
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
@endsection
