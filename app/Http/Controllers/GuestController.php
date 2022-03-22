<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Modules\MainView;
use App\Models\Cafe;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    use MainView;
    public function index()
    {
        $cafe = Cafe::first();
        if ($cafe->show_lp != "true") {
            return to_route('login');
        }
        return $this->main_view('home');
    }

    public function login()
    {
        return $this->main_view('auth.login');
    }

    public function register()
    {
        return $this->main_view('auth.register');
    }
}
