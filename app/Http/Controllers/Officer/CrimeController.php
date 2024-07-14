<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Crime;
use App\Models\Image;
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
        return view('officer.create_most_wanted');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'date_occurred'=>'required|date',
            'is_most_wanted'=>'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each uploaded image
        ]);

        // Store the crime details in the database
        $crime = new Crime();
        $crime->name = $validatedData['name'];
        $crime->is_most_wanted=true;
        $crime->category = $validatedData['category'];
        $crime->location = $validatedData['location'];
        $crime->description = $validatedData['description'];
        $crime->date_occurred =$validatedData['date_occurred'];
        $crime->reported_by = auth()->user()->username;
        $crime->save();

        // Upload and store the images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/crime_images', $imageName); 

                $imageModel= new Image();
                $imageModel->path=$imageName;
                $imageModel->crime_id =$crime->id;  
                $imageModel->save();              
            }
        }

        // Redirect the user back with a success message
        return redirect()->route('officer.reports.most.wanted')->with('success', 'Crime reported successfully.');
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
