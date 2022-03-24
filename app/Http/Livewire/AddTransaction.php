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
    /* This is a variable that is used to determine whether the customer is guest or not. */
    public $notGuest = true, $subcription, $id_customer = null, $discount, $notSupported = false, $invoice, $payment_status;
    /* This is a variable that is used to determine the total price of the transaction. */
    public $qty, $total = 0;

    /* This is a variable that is used to determine the rules of the validation. */
    protected $rules = [
        'invoice' => 'required',
        'qty.*' => 'required',
        'payment_status' => 'required|in:paid,waiting,cancelled'
    ];

    /**
     * This function is used to calculate the total price of the order
     */
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

    /**
     * If the customer has a subcription, then set the subcription and discount
     */
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

   /**
    * If the user is logged in, then they are not a guest. If they are not logged in, then they are a
    * guest
    */
    public function guestMode()
    {
        if ($this->notGuest) {
            $this->notGuest = false;
        } else {
            $this->notGuest = true;
        }
    }

    /**
     * Generate a random string of 20 characters
     */
    public function generate()
    {
        $this->invoice = Str::random(20);
    }

   /**
    * This function is used to create a new transaction
    * 
    * @return The transaction has been created.
    */
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

    /**
     * This function is used to render the view for the add-transaction component
     * 
     * @return The view is being returned.
     */
    public function render()
    {
        $customers = Customers::with('subcription')->where('status', 'active')->get();
        $menus = Menu::with('category')->where('status', 'production')->get();
        return view('livewire.add-transaction', compact('customers', 'menus'))->extends('layouts.main', ['appName' => Cafe::first()->name])->section('content');
    }
}
