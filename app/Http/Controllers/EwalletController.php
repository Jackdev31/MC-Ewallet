<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ewallet\StoreLoadRequest;
use App\Http\Requests\Ewallet\UpdateLoadRequest;
use App\Models\Ewallet;
use App\Models\User;
use Illuminate\Http\Request;

class EwalletController extends Controller
{
    /**
     * Display a listing of all e-wallets.
     */
    public function index()
    {
        $users = User::with('ewallet')->get();
        return view('e-wallets.index', compact('users'));
    }

    /**
     * Show the form for loading credits into the user's e-wallet.
     */
    public function loadForm(User $user)
    {
        return view('e-wallets.load', compact('user'));
    }

    /**
     * Store credits in the user's e-wallet.
     */
    public function store(StoreLoadRequest $request, User $user)
    {
        $validated = $request->validated();

        // Check if user has an e-wallet; if not, create one
        $ewallet = $user->ewallet()->firstOrCreate([], [
            'balance' => 0,
        ]);

        // Add the amount to the balance
        $ewallet->balance += $validated['amount'];
        $ewallet->save();

        return redirect()->route('e-wallets.index')->with('success', 'Amount loaded successfully!');
    }

    /**
     * Show the specified user's e-wallet details.
     */
   

    /**
     * Edit the user's e-wallet (optional for later).
     */
    public function edit(User $user)
    {
        return view('e-wallets.edit', compact('user'));
    }

    public function update(UpdateLoadRequest $request, User $user)
{
    $validated = $request->validated();

    $ewallet = $user->ewallet;

    if ($ewallet) {
        $ewallet->balance = $validated['balance'];
        $ewallet->save();

        return redirect()->route('e-wallets.index')->with('success', 'E-wallet balance updated successfully.');
    }

    return redirect()->route('e-wallets.index')->with('error', 'E-wallet not found.');
}
}


