<?php

namespace App\Http\Controllers;

use App\Models\Crime;
use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    function popular() : View {
        $items=Crime::where('is_most_wanted', 1)->orderBy('created_at','desc')->limit(5)->get();
        return view('welcome',['foundItems'=>$items,'type'=>3]);
    }

    function foundItems() : View {
        $items=LostItem::where('is_found', 1)->orderBy('created_at','desc')->limit(5)->get();
        return view('welcome',['foundItems'=>$items,'type'=>2]);
        
    }

    function lostItems() : View {
        $items=LostItem::where('is_found', 0)->orderBy('created_at','desc')->limit(5)->get();
        return view('welcome',['foundItems'=>$items,'type'=>1]);
        
    }
}
