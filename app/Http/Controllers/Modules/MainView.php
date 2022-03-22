<?php

namespace App\Http\Controllers\Modules;

use App\Models\Cafe;

trait MainView
{
    public function main_view($viewName, $data = [])
    {
        if ($data !== [] && array_key_exists('appName', $data)) {
            throw new \Exception("appName key cannot be overriden.");
        }
        $data['appName'] = Cafe::first()->name;
        return view($viewName, $data);
    }
}
