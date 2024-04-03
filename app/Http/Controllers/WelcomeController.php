<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    function popular() : View {
        return view('welcome');
    }

    function mostWanted() : View {
        return view('welcome');
        
    }

    function lostItems() : View {
        return view('welcome');
        
    }
}
