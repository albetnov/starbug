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

    /**
     * This function will return the view of the dashboard
     * 
     * @return The view file.
     */
    public function dashboard()
    {
        return $this->main_view('owner.dashboard');
    }

    /**
     * This function will return the view for the users page
     * 
     * @return The view file.
     */
    public function users()
    {
        $users = User::latest()->get();
        $appName = Cafe::first()->name;
        return $this->main_view('owner.users.index', compact('users'));
    }

    /**
     * This function creates a view that displays the create user form
     * 
     * @return The view.
     */
    public function createUser()
    {
        return $this->main_view('owner.users.create');
    }

    /**
     * Create a new user
     * 
     * @param Request request The request object.
     * 
     * @return The user is being returned to the users page.
     */
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

    /**
     * This function will return the view for editing a user
     * 
     * @param User user The user object that we want to edit.
     * 
     * @return The view 'owner.users.edit'
     */
    public function editUser(User $user)
    {
        return $this->main_view('owner.users.edit', compact('user'));
    }

    /**
     * This function is used to edit a user
     * 
     * @param User user The user model to be updated.
     * @param Request request The request object.
     * 
     * @return The user is being returned to the users page.
     */
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

    /**
     * This function deletes a user from the database
     * 
     * @param User user The user model that we want to delete.
     * 
     * @return A redirect to the users page.
     */
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

    /**
     * This function updates the role of a user to cashier
     * 
     * @param User user The user model that is being updated.
     * 
     * @return The route to the users page with a success message.
     */
    public function upgradeUser(User $user)
    {
        $user->update(['role' => 'cashier']);

        $notif = [
            'toast' => 'success',
            'message' => 'User updated'
        ];

        return to_route('owner.users')->with($notif);
    }

    /**
     * This function is used to display the cafe page
     * 
     * @return The view 'owner.cafe' with the variable 'cafe' being passed in.
     */
    public function cafe()
    {
        $cafe = Cafe::first();
        return $this->main_view('owner.cafe',  ['cafe' => $cafe]);
    }

    /**
     * The function is used to edit the cafe's name and address
     * 
     * @param Request request The request object.
     * 
     * @return The view of the cafe page.
     */
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

    /**
     * This function will show all the categories in the database
     * 
     * @return The view is being returned.
     */
    public function showCategory()
    {
        $categories = Category::latest()->get();
        return $this->main_view('owner.categories.index', compact('categories'));
    }

    /**
     * This function creates a new category
     * 
     * @return A view.
     */
    public function createCategory()
    {
        return $this->main_view('owner.categories.create');
    }

    /**
     * Create a new category
     * 
     * @param Request request The request object.
     * 
     * @return The view of the category page.
     */
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

    /**
     * This function will return the view for editing a category
     * 
     * @param Category category The category that we want to edit.
     * 
     * @return The view.
     */
    public function editCategory(Category $category)
    {
        return $this->main_view('owner.categories.edit', compact('category'));
    }

    /**
     * The function takes in a category and a request object. It validates the request object and
     * updates the category with the validated data. It then returns a route to the category page with
     * a success message
     * 
     * @param Category category The category model instance.
     * @param Request request The request object.
     * 
     * @return A view.
     */
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

    /**
     * This function deletes a category
     * 
     * @param Category category The category to delete.
     * 
     * @return A response object.
     */
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
