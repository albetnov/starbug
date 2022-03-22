<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileManager extends Controller
{
    public function show()
    {
        return view('profile');
    }

    public function edit(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'username' => 'required|max:64|unique:users,id,' . Auth::user()->id,
            'password' => 'nullable|min:8',
            'conpass' => 'same:password|required_with:password',
            'propic' => 'nullable|max:2048|mimes:jpg,jpeg,png'
        ]);

        $data = [
            'name' => $request->fullname,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ];

        if ($request->propic) {
            $data['propic'] = time() . hash("sha256", $request->propic->getClientOriginalName()) . $request->propic->getClientOriginalName();
            Storage::putFileAs('public/propic', $request->propic, $data['propic']);
        }

        $notif = [
            'toast' => 'success',
            'message' => 'Account updated'
        ];

        try {
            User::find(Auth::user()->id)->update($data);
        } catch (ModelNotFoundException $e) {
            $notif = [
                'toast' => 'error',
                'message' => 'Account failed to update'
            ];
        }

        return redirect()->route('profile')->with($notif);
    }
}
