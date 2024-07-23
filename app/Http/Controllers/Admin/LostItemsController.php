<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LostItem;
use Illuminate\Http\Request;

class LostItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lost_items = LostItem::paginate(10);
        return view('admin.lost_items_reports', ['lostItems' => $lost_items]);
    }

    public function markAsSolved($lostItemId)
    {
        $lostItem = LostItem::findOrFail($lostItemId);
        $lostItem->is_found = !$lostItem->is_found;
        $lostItem->save();

        return back()->with('success', 'Marked successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => ['required'],
        ]);
        $query = $request->query('query');

        $lostItems = LostItem::where('name', 'like', '%' . $query . '%')
            ->orWhere('category', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->paginate(10);
        return view('admin.lost_items_reports', ['lostItems' => $lostItems]);
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
