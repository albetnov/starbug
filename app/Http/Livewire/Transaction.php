<?php

namespace App\Http\Livewire;

use App\Models\Cafe;
use App\Models\Transaction as ModelsTransaction;
use App\Models\TransactionMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Transaction extends Component
{
    /* This is a variable that is used to determine whether the user has clicked the filter button or
   not. */
    public $filter = false, $status, $details = false, $detailReady, $name;

    /**
     * This function is called when the user updates the status of a payment
     * 
     * @param fields The fields that you want to update.
     */
    public function updated($fields)
    {
        if ($fields == 'status') {
            $this->validate([
                'status' => 'in:paid,waiting,cancelled'
            ]);

            $this->filter = true;
        }
    }

    /**
     * This function will get the details of a transaction and the name of the customer
     * 
     * @param id The id of the transaction to show the details of.
     */
    public function showDetail($id)
    {
        $this->details = TransactionMenu::with('transaction', 'menu')->where('id_transaction', $id)->get();
        $this->name = ModelsTransaction::find($id)->customer->name ?? 'Guest';
        $this->detailReady = true;
        $this->emit('showDetail');
    }

    /**
     * This function is used to delete a transaction
     * 
     * @param id The ID of the model to delete.
     * 
     * @return The return is a redirect to the route that was specified in the route() method.
     */
    public function delete($id)
    {
        DB::transaction(function () use ($id) {
            TransactionMenu::where('id_transaction', $id)->delete();
            ModelsTransaction::find($id)->delete();
        });

        $notif = [
            'toast' => 'success',
            'message' => 'Transaction deleted'
        ];

        if (Auth::user()->role == 'owner') {
            return to_route('owner.transaction')->with($notif);
        } else {
            return to_route('cashier.transaction')->with($notif);
        }
    }

    /**
     * This function is used to render the transactions page
     * 
     * @return The view is being returned.
     */
    public function render()
    {
        $transactions = ModelsTransaction::with('transactionMenu')->latest()->get();
        if ($this->filter) {
            $transactions = ModelsTransaction::with('transactionMenu')->where('payment_status', $this->status)->latest()->get();
        }
        return view('livewire.transaction', compact('transactions'))->extends('layouts.main', ['appName' => Cafe::first()->name])->section('content');
    }
}
