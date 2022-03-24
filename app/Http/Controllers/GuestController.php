<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Modules\MainView;
use App\Models\Cafe;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    use MainView;
    /**
     * This function is called when the user visits the home page. 
     * It checks to see if the user is logged in. If they are, it redirects them to the dashboard. 
     * If they aren't, it redirects them to the login page
     * 
     * @return The view 'home'
     */
    public function index()
    {
        $cafe = Cafe::first();
        if ($cafe->show_lp != "true") {
            return to_route('login');
        }
        return $this->main_view('home');
    }

    /**
     * This function returns the login view
     * 
     * @return The login view.
     */
    public function login()
    {
        return $this->main_view('auth.login');
    }

    /**
     * This function will return the register view
     * 
     * @return The register view.
     */
    public function register()
    {
        return $this->main_view('auth.register');
    }

    /**
     * This function returns the disabled view
     * 
     * @return The disabled view.
     */
    public function disabled()
    {
        return $this->main_view('disabled');
    }
}
