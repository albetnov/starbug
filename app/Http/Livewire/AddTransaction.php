<?php

namespace App\Http\Livewire;

use App\Models\Cafe;
use App\Models\Customers;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class AddTransaction extends Component
{
    public $notGuest = true, $subcription, $id_customer = null, $discount, $notSupported = false, $invoice, $payment_status;
    public $qty, $total = 0;

    protected $rules = [
        'invoice' => 'required',
        'qty.*' => 'required',
        'payment_status' => 'required|in:paid,waiting,cancelled'
    ];

    public function caculate()
    {
        $total = 0;
        foreach ($this->qty as $qty => $value) {
            $total += $value * Menu::find($qty)->price;
            $this->total = $total;
            if ($this->id_customer != null) {
                $subcription = Customers::with('subcription')->find($this->id_customer)->subcription;
                if ($subcription->status == 'applecible') {
                    $this->total -= $total * $subcription->discount / 100;
                }
            }
        }
    }

    public function updatedIdCustomer()
    {
        if ($this->id_customer != null) {
            $subcription = Customers::with('subcription')->find($this->id_customer)->subcription;
            $this->subcription = $subcription->name;
            $this->discount = $subcription->discount;
            $this->notSupported = false;
            if ($subcription->status == 'not_applecible') {
                $this->subcription = "{$subcription->name}: Not applecible";
                $this->discount = "Discount inactive due to unsupported subcription.";
                $this->notSupported = $this->id_customer;
            }
        } else {
            $this->subcription = null;
            $this->discount = null;
            $this->notSupported = false;
        }
    }

    public function guestMode()
    {
        if ($this->notGuest) {
            $this->notGuest = false;
        } else {
            $this->notGuest = true;
        }
    }

    public function generate()
    {
        $this->invoice = Str::random(20);
    }

    public function create()
    {
        $this->validate();
        DB::transaction(function () {
            $data = Transaction::create([
                'id_customer' => $this->id_customer,
                'invoice' => $this->invoice,
                'payment_status' => $this->payment_status,
                'price' => $this->total
            ]);
            foreach ($this->qty as $qty => $value) {
                TransactionMenu::create([
                    'id_transaction' => $data->id,
                    'id_menu' => $qty,
                    'qty' => $value,
                ]);
            }
        });

        $notif = [
            'toast' => 'success',
            'message' => 'Transaction has been created.'
        ];

        if (Auth::user()->role == 'owner') {
            return to_route('owner.transaction')->with($notif);
        } else {
            return to_route('cashier.transaction')->with($notif);
        }
    }

    public function render()
    {
        $customers = Customers::with('subcription')->where('status', 'active')->get();
        $menus = Menu::with('category')->where('status', 'production')->get();
        return view('livewire.add-transaction', compact('customers', 'menus'))->extends('layouts.main', ['appName' => Cafe::first()->name])->section('content');
    }
}
