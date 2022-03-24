<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Modules\MainView;
use App\Models\Cafe;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileManager extends Controller
{
    use MainView;
    
    /**
     * This function displays the profile page
     * 
     * @return The view is being returned.
     */
    public function show()
    {
        return $this->main_view('profile');
    }

   /**
    * Update the user's account
    * 
    * @param Request request The request object.
    * 
    * @return Nothing.
    */
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
        ];

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->propic) {
            $data['propic'] = time()  . $request->propic->hashName();
            Storage::putFileAs('public/propic', $request->propic, $data['propic']);
        }

        $notif = [
            'toast' => 'success',
            'message' => 'Account updated'
        ];

        try {
            $user = User::find(Auth::user()->id);
            if ($user->propic && $user->propic != "default.png") {
                Storage::delete('public/propic/' . $user->propic);
            }
            $user->update($data);
        } catch (ModelNotFoundException $e) {
            $notif = [
                'toast' => 'error',
                'message' => 'Account failed to update'
            ];
        }

        return to_route('profile')->with($notif);
    }

    /**
     * If the user has ticked the box, delete the user's account
     * 
     * @param Request request The request object.
     * 
     * @return Nothing.
     */
    public function delete(Request $request)
    {
        if (!$request->accountDeletion) {
            $notif = [
                'toast' => 'error',
                'message' => 'Please tick the box.'
            ];
            return to_route('profile')->with($notif);
        }
        try {
            $user = User::find(Auth::user()->id);

            if ($user->propic && $user->propic != "default.png") {
                Storage::delete('public/propic/' . $user->propic);
            }
            $user->delete();
        } catch (ModelNotFoundException $e) {
            $notif = [
                'toast' => 'error',
                'message' => 'Account failed to delete'
            ];
            return to_route('profile')->with($notif);
        }

        (new AuthController)->logout($request);
        return to_route('login')->with('message', 'Account deleted.');
    }
}