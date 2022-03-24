<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Modules\MainView;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    use MainView;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menus = Menu::with('category')->get();
        $rules = ['production', 'discontinued'];
        if ($request->status && in_array($request->status, $rules)) {
            $menus = Menu::with('category')->where('status', $request->status)->get();
        }

        return $this->main_view('menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->main_view('menu.create', ['categories' => Category::get()]);
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
            'description' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|in:production,discontinued',
            'photo' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);
        $data['photo'] = time() . $request->photo->hashName();
        $data['id_category'] = $data['category'];
        unset($data['category']);
        Storage::putFileAs('public/menu', $request->photo, $data['photo']);

        Menu::create($data);

        $notif = [
            'toast' => 'success',
            'message' => 'Menu created'
        ];
        if (Auth::user()->role == 'owner') {
            return to_route('owner.menu')->with($notif);
        } else {
            return to_route('cashier.menu')->with($notif);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $categories = Category::get();
        return $this->main_view('menu.edit', compact('menu', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'name' => 'required|max:64',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|in:production,discontinued',
            'photo' => 'nullable|mimes:jpg,jpeg,png|max:2048'
        ]);
        unset($data['photo']);

        if ($request->photo) {
            $data['photo'] = time() . $request->photo->hashName();
            Storage::delete('public/menu/' . $menu->photo);
            Storage::putFileAs('public/menu', $request->photo, $data['photo']);
        }

        $data['id_category'] = $data['category'];
        unset($data['category']);


        $menu->update($data);

        $notif = [
            'toast' => 'success',
            'message' => 'Menu updated'
        ];

        if (Auth::user()->role == 'owner') {
            return to_route('owner.menu')->with($notif);
        } else {
            return to_route('cashier.menu')->with($notif);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if ($menu->photo) {
            Storage::delete('public/menu/' . $menu->photo);
        }

        $menu->delete();

        $notif = [
            'toast' => 'success',
            'message' => 'Menu deleted'
        ];

        if (Auth::user()->role == 'owner') {
            return to_route('owner.menu')->with($notif);
        } else {
            return to_route('cashier.menu')->with($notif);
        }
    }
}
