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
    public $filter = false, $status, $details = false, $detailReady, $name;
    public function updated($fields)
    {
        if ($fields == 'status') {
            $this->validate([
                'status' => 'in:paid,waiting,cancelled'
            ]);

            $this->filter = true;
        }
    }

    public function showDetail($id)
    {
        $this->details = TransactionMenu::with('transaction', 'menu')->where('id_transaction', $id)->get();
        $this->name = ModelsTransaction::find($id)->customer->name;
        $this->detailReady = true;
        $this->emit('showDetail');
    }

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

    public function render()
    {
        $transactions = ModelsTransaction::with('transactionMenu')->get();
        if ($this->filter) {
            $transactions = ModelsTransaction::with('transactionMenu')->where('payment_status', $this->status)->get();
        }
        return view('livewire.transaction', compact('transactions'))->extends('layouts.main', ['appName' => Cafe::first()->name])->section('content');
    }
}
