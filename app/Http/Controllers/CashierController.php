<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Modules\MainView;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    use MainView;
    /**
     * This function is used to display the dashboard view
     * 
     * @return The dashboard view.
     */
    public function dashboard()
    {
        return $this->main_view('cashier.dashboard');
    }
}
