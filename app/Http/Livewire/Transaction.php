<?php

namespace App\Http\Livewire;

use App\Models\Cafe;
use App\Models\Transaction as ModelsTransaction;
use Livewire\Component;

class Transaction extends Component
{
    public $filter = false, $status;
    public function updated($fields)
    {
        if ($fields == 'status') {
            $this->validate([
                'status' => 'in:paid,waiting,cancelled'
            ]);

            $this->filter = true;
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
