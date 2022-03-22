<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Modules\MainView;
use App\Models\Cafe;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OwnerController extends Controller
{
    use MainView;
    public function dashboard()
    {
        return $this->main_view('owner.dashboard');
    }

    public function users()
    {
        $users = User::latest()->get();
        $appName = Cafe::first()->name;
        return $this->main_view('owner.users.index', compact('users'));
    }

    public function createUser()
    {
        return $this->main_view('owner.users.create');
    }

    public function performCreateUser(Request $request)
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
        return $this->main_view('owner.users.edit', compact('user'));
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

    public function upgradeUser(User $user)
    {
        $user->update(['role' => 'cashier']);

        $notif = [
            'toast' => 'success',
            'message' => 'User updated'
        ];

        return to_route('owner.users')->with($notif);
    }

    public function cafe()
    {
        $cafe = Cafe::first();
        return $this->main_view('owner.cafe',  ['cafe' => $cafe]);
    }

    public function editCafe(Request $request)
    {
        $request->validate([
            'cafe_name' => 'required|max:64',
            'cafe_address' => 'required',
        ]);

        $data = [
            'name' => $request->cafe_name,
            'address' => $request->cafe_address,
            'show_lp' => $request->disable_lp ? "false" : "true"
        ];

        Cafe::first()->update($data);

        $notif = [
            'toast' => 'success',
            'message' => 'Changes saved'
        ];

        return to_route('owner.cafe')->with($notif);
    }

    public function showCategory()
    {
        $categories = Category::latest()->get();
        return $this->main_view('owner.categories.index', compact('categories'));
    }

    public function createCategory()
    {
        return $this->main_view('owner.categories.create');
    }

    public function performCreateCategory(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:64',
            'description' => 'required'
        ]);

        Category::create($data);

        $notif = [
            'toast' => 'success',
            'message' => 'Category created'
        ];

        return to_route('owner.category')->with($notif);
    }

    public function editCategory(Category $category)
    {
        return $this->main_view('owner.categories.edit', compact('category'));
    }

    public function performEditCategory(Category $category, Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:64',
            'description' => 'required'
        ]);

        $category->update($data);

        $notif = [
            'toast' => 'success',
            'message' => 'Category updated'
        ];

        return to_route('owner.category')->with($notif);
    }

    public function performDelCategory(Category $category)
    {
        $category->delete();

        $notif = [
            'toast' => 'success',
            'message' => 'Category deleted'
        ];

        return to_route('owner.category')->with($notif);
    }
}
