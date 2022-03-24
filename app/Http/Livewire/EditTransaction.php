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

class EditTransaction extends Component
{
    /* This is a variable that is used to determine whether the transaction is a guest transaction or
    not. */
    public $notGuest = true, $subcription, $id_customer = null, $discount, $notSupported = false, $invoice, $payment_status;
    /* This is a variable that is used to store the quantity of each menu that is ordered. */
    public $qty, $total = 0, $transaction, $details;

    /* This is a variable that is used to validate the input of the form. */
    protected $rules = [
        'invoice' => 'required',
        'qty.*' => 'required',
        'payment_status' => 'required|in:paid,waiting,cancelled'
    ];

    /**
     * This function is used to mount the data of the transaction to the view
     * 
     * @param Transaction transaction The transaction object.
     */
    public function mount(Transaction $transaction)
    {
        $this->id_customer = $transaction->id_customer ?? null;
        if ($this->id_customer == null) {
            $this->notGuest = false;
        }
        $this->invoice = $transaction->invoice;
        $this->payment_status = $transaction->payment_status;
        $this->discount = $transaction->discount;
        $this->subcription = $transaction->subcription;
        $this->total = $transaction->price;
        $this->details = TransactionMenu::with('transaction', 'menu')->where('id_transaction', $transaction->id)->get();
        foreach ($this->details as $detail) {
            $this->qty[$detail->id_menu] = $detail->qty;
        }
        $this->transaction = $transaction;
    }

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
        if ($this->id_customer != "") {
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
     * Update the transaction
     * 
     * @return The return is the route to the cashier or owner transaction page.
     */
    public function update()
    {
        $this->validate();
        DB::transaction(function () {
            $this->transaction->update([
                'id_customer' => $this->id_customer,
                'invoice' => $this->invoice,
                'payment_status' => $this->payment_status,
                'price' => $this->total
            ]);
            foreach ($this->qty as $qty => $value) {
                TransactionMenu::where('id_transaction', $this->transaction->id)->where('id_menu', $qty)->update([
                    'id_transaction' => $this->transaction->id,
                    'id_menu' => $qty,
                    'qty' => $value,
                ]);
            }
        });

        $notif = [
            'toast' => 'success',
            'message' => 'Transaction has been edited.'
        ];

        if (Auth::user()->role == 'owner') {
            return to_route('owner.transaction')->with($notif);
        } else {
            return to_route('cashier.transaction')->with($notif);
        }
    }

   /**
    * This function is used to render the edit-transaction component
    * 
    * @return The view is being returned.
    */
    public function render()
    {
        $customers = Customers::with('subcription')->where('status', 'active')->get();
        $menus = Menu::with('category')->where('status', 'production')->get();
        return view('livewire.edit-transaction', compact('customers', 'menus'))->extends('layouts.main', ['appName' => Cafe::first()->name])->section('content');
    }
}
