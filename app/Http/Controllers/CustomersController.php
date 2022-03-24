<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Modules\MainView;
use App\Models\Customers;
use App\Models\Subcriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller
{
    use MainView;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customers::with('subcription')->get();
        $rules = ['active', 'inactive'];
        if ($request->status && in_array($request->status, $rules)) {
            $customers = Customers::where('status', $request->status)->get();
        }

        return $this->main_view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcriptions = Subcriptions::where('status', 'applecible')->get();
        return $this->main_view('customers.create', compact('subcriptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:64',
            'id_subcription' => 'required',
            'status' => 'required|in:active,inactive'
        ]);

        Customers::create($data);

        $notif = [
            'toast' => 'success',
            'message' => 'Customer created successfully'
        ];

        if (Auth::user()->role == 'owner') {
            return to_route('owner.customers')->with($notif);
        } else {
            return to_route('cashier.customers')->with($notif);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customers  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customers $customer)
    {
        $subcriptions = Subcriptions::where('status', 'applecible')->get();
        return $this->main_view('customers.edit', compact('customer', 'subcriptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customers  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customers $customer)
    {
        $data = $request->validate([
            'name' => 'required|max:64',
            'id_subcription' => 'required',
            'status' => 'required|in:active,inactive'
        ]);

        $customer->update($data);

        $notif = [
            'toast' => 'success',
            'message' => 'Customer updated successfully'
        ];

        if (Auth::user()->role == 'owner') {
            return to_route('owner.customers')->with($notif);
        } else {
            return to_route('cashier.customers')->with($notif);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customers  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customers $customer)
    {
        $customer->delete();

        $notif = [
            'toast' => 'success',
            'message' => 'customer deleted successfully'
        ];

        if (Auth::user()->role == 'owner') {
            return to_route('owner.customers')->with($notif);
        } else {
            return to_route('cashier.customers')->with($notif);
        }
    }
}
