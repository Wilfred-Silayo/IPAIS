<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Crime;
use App\Models\LostItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->role==='admin'){
            $users=User::orderByDesc('created_at')->paginate(10);
            $reporters=User::where('role','reporter')->count();
            $officers=User::where('role','officer')->count();
            return view('admin.dashboard',[
                "reporters"=>$reporters,
                "officers"=>$officers,
                "users"=>$users,
            ]);
        }
        elseif(Auth::user()->role==='officer'){
            $lost_items=LostItem::all()->count();
            $lost_items_found=LostItem::where('is_found',true)->count();
            $crimes=Crime::all()->count();
            $crimes_resolved=Crime::where('is_resolved',true)->count();
            return view('officer.dashboard',[
                "lost_items"=>$lost_items,
                "lost_items_found"=>$lost_items_found,
                "crimes"=>$crimes,
                "crimes_resolved"=>$crimes_resolved,
            ]); 
        }
        else{
            $lost_items=LostItem::all()->count();
            $lost_items_found=LostItem::where('is_found',true)->count();
            $crimes=Crime::all()->count();
            $crimes_resolved=Crime::where('is_resolved',true)->count();
            return view('reporter.dashboard',[
                "lost_items"=>$lost_items,
                "lost_items_found"=>$lost_items_found,
                "crimes"=>$crimes,
                "crimes_resolved"=>$crimes_resolved,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
