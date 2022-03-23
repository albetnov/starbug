<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Modules\MainView;
use App\Models\Subcriptions;
use Illuminate\Http\Request;

class SubcriptionsController extends Controller
{
    use MainView;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subcriptions = Subcriptions::get();
        $rules = ['applecible', 'not_applecible'];
        if ($request->status && in_array($request->status, $rules)) {
            $subcriptions = Subcriptions::where('status', $request->status)->get();
        }
        return $this->main_view('subcription.index', compact('subcriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->main_view('subcription.create');
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
            'discount' => 'required|numeric|max:100|min:0',
            'minimum_order' => 'required|numeric',
            'price' => 'required|numeric',
            'status' => 'required|in:applecible,not_applecible'
        ]);

        Subcriptions::create($data);

        $notif = [
            'toast' => 'success',
            'message' => 'Subcription created successfully'
        ];

        return to_route('owner.subcription')->with($notif);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcriptions  $subcription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcriptions $subcription)
    {
        return $this->main_view('subcription.edit', compact('subcription'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcriptions  $subcription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcriptions $subcription)
    {
        $data = $request->validate([
            'name' => 'required|max:64',
            'discount' => 'required|numeric|max:100|min:0',
            'minimum_order' => 'required|numeric',
            'price' => 'required|numeric',
            'status' => 'required|in:applecible,not_applecible'
        ]);

        $subcription->update($data);

        $notif = [
            'toast' => 'success',
            'message' => 'Subcription updated successfully'
        ];

        return to_route('owner.subcription')->with($notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcriptions  $subcription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcriptions $subcription)
    {
        $subcription->delete();

        $notif = [
            'toast' => 'success',
            'message' => 'Subcription deleted successfully'
        ];

        return to_route('owner.subcription')->with($notif);
    }
}
