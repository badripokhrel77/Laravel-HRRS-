<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction; // Import the Transaction model
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
        // Retrieve all transactions from the database
        $transactions = Transaction::all();

        // Pass the transactions to the view
        return view('admin.transaction.index', compact('transactions'));
    }
    public function show($id)
    {
       
        // Fetch the room booking by ID
        $transactions = Transaction::findOrFail($id);

        // Return the view with the room booking data
        return view('admin.transaction.show', [
            'transaction' => $transactions
        ]);
    }

}
