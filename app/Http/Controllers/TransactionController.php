<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'moderator' => 'required|exists:users,id,account_type,moderator',
            'transaction_type' => 'required|in:deposit,withdrawal,explained',
            'amount' => 'required|numeric|max:9999999999.99',
            'reference' => 'nullable|string',
            'mode' => 'required|in:mpesa,world_coin',
            'contact_type' => 'required|in:phone_number,worldcoin_address',
            'contact' => 'required|string',
            'status' => 'nullable', // Assuming 'status' is optional and defaults to null
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $moderator = User::find($request->input('moderator'));

        $transaction = Transaction::create([
            'initiator' => Auth::user()->id,
            'moderator' => $moderator->id,
            'transaction_type' => $request->input('transaction_type'),
            'amount' => $request->input('amount'),
            'reference' => $request->input('reference'),
            'mode' => $request->input('mode'),
            'contact_type' => $request->input('contact_type'),
            'contact' => $request->input('contact'),
            'receiver_type' => $request->input('contact'),
            'receiver' => $request->input('contact'),
            'status' => $request->input('status'),
        ]);

        return response()->json($transaction, 201);
    }
}


