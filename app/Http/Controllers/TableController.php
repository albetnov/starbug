<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Modules\MainView;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    use MainView;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tables = Table::latest()->get();
        $rules = ['useable', 'broken'];
        if ($request->status && in_array($request->status, $rules)) {
            $tables = Table::where('status', $request->status)->get();
        }
        return $this->main_view('tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->main_view('tables.create');
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
            'seat' => 'required|numeric',
            'status' => 'required|in:useable,broken'
        ]);

        Table::create($data);

        $notif = [
            'toast' => "success",
            'message' => "Table created"
        ];

        return to_route('owner.tables')->with($notif);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        return $this->main_view('tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Table $table)
    {
        $data = $request->validate([
            'name' => 'required|max:64',
            'seat' => 'required|numeric',
            'status' => 'required|in:useable,broken'
        ]);

        $table->update($data);

        $notif = [
            'toast' => "success",
            'message' => "Table updated"
        ];

        return to_route('owner.tables')->with($notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        $table->delete();

        $notif = [
            'toast' => "success",
            'message' => "Table deleted"
        ];

        return to_route('owner.tables')->with($notif);
    }
}
