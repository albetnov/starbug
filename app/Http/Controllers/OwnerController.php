<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OwnerController extends Controller
{
    public function users()
    {
        $users = User::get();
        return view('owner.users.index', compact('users'));
    }

    public function createUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|max:64|unique:users,id,' . Auth::user()->id,
            'password' => 'required|min:8',
            'conpass' => 'same:password|required',
            'role' => 'required|in:owner,cashier,disabled',
            'propic' => 'nullable|max:2048|mimes:jpg,jpeg,png'
        ]);

        if ($request->propic) {
            $data['propic'] = time() . $request->propic->hashName();
            Storage::putFileAs('public/propic', $request->propic, $data['propic']);
        }

        unset($data['conpass']);
        $data['password'] = bcrypt($data['password']);
        User::create($data);

        $notif = [
            'toast' => 'success',
            'message' => 'User created'
        ];

        return to_route('owner.users')->with($notif);
    }

    public function editUser(User $user)
    {
        return view('owner.users.edit', compact('user'));
    }

    public function performEditUser(User $user, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|max:64|unique:users,id,' . Auth::user()->id,
            'password' => 'nullable|min:8',
            'conpass' => 'same:password|required_with:password',
            'role' => 'required|in:owner,cashier,disabled',
            'propic' => 'nullable|max:2048|mimes:jpg,jpeg,png'
        ]);

        if ($request->propic) {
            if ($user->propic && $user->propic != "default.png") {
                Storage::delete('public/propic/' . $user->propic);
            }
            $data['propic'] = time() . $request->propic->hashName();
            Storage::putFileAs('public/propic', $request->propic, $data['propic']);
        }

        unset($data['conpass']);
        $data['password'] = bcrypt($data['password']);

        if (!$request->password) {
            unset($data['password']);
        }

        $user->update($data);

        $notif = [
            'toast' => 'success',
            'message' => 'User updated'
        ];

        return to_route('owner.users')->with($notif);
    }

    public function performDelUser(User $user)
    {
        if ($user->propic && $user->propic != "default.png") {
            Storage::delete('public/propic/' . $user->propic);
        }

        $user->delete();

        $notif = [
            'toast' => 'success',
            'message' => 'User deleted'
        ];

        return to_route('owner.users')->with($notif);
    }
}
