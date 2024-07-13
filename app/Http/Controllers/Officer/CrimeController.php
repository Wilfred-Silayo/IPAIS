<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Crime;
use Illuminate\Http\Request;

class CrimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crimes = Crime::where('is_most_wanted', 0)->paginate(10);
        return view('officer.crime_reports', ['crimes' => $crimes]);
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
    public function show()
    {
        $crimes = Crime::where('is_most_wanted', 1)->paginate(10);
        return view('officer.most_wanted_reports', ['crimes' => $crimes]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function markAsSolved($crimeId)
    {
        $crime = Crime::findOrFail($crimeId);
        $crime->is_resolved = !$crime->is_resolved;
        $crime->save();

        return back()->with('success', 'Marked successfully');
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => ['required'],
        ]);
        $query = $request->query('query');


        $crimes = Crime::where('is_most_wanted', 0)
            ->where('name', 'like', '%' . $query . '%')
            ->orWhere('category', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->paginate(10);
        return view('officer.crime_reports', ['crimes' => $crimes]);
    }


    public function searchMostWanted(Request $request)
    {
        $request->validate([
            'query' => ['required'],
        ]);
        $query = $request->query('query');


        $crimes = Crime::where('is_most_wanted', 1)
            ->where('name', 'like', '%' . $query . '%')
            ->orWhere('category', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->paginate(10);
        return view('officer.crime_reports', ['crimes' => $crimes]);
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
