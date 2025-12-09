<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the landing page or redirect authenticated users.
     */
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('app.index');
        }

        return view('home');
    }
}
