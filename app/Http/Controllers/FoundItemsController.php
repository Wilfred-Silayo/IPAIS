<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use Illuminate\Http\Request;

class FoundItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foundItems=LostItem::where('is_found',1)->paginate(10);
        return view('reporter.view_found_items',['foundItems'=>$foundItems]);

    }

    public function search(Request $request){
        $request->validate([
            'query'=>['required'],
        ]);
        $query = $request->query('query');
    
    
            $foundItems = LostItem::where('is_found',1)
                ->where('name', 'like', '%' . $query . '%')
                ->orWhere('category', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->paginate(10);
            return view('reporter.view_found_items', ['foundItems' => $foundItems]);
    }


}
