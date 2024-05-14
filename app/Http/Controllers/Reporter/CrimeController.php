<?php

namespace App\Http\Controllers\Reporter;

use App\Http\Controllers\Controller;
use App\Models\Crime;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CrimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username=Auth::user()->username;
        $crimes=Crime::where('reported_by',$username)->paginate(10);
        return view('reporter.report_crime',['crimes'=>$crimes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reporter.create_crime');
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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each uploaded image
        ]);

        // Store the crime details in the database
        $crime = new Crime();
        $crime->name = $validatedData['name'];
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
        return redirect()->route('reporter.report.crime')->with('success', 'Crime reported successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('reporter.view_most_wanted');
        
    }

    public function search(Request $request){
        $request->validate([
            'query'=>['required'],
        ]);
        $username=Auth::user()->username;
        $query = $request->query('query');
    
    
            $crimes = Crime::where('reported_by', $username)
                ->where('name', 'like', '%' . $query . '%')
                ->orWhere('category', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->paginate(10);
            return view('reporter.report_crime', ['crimes' => $crimes]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function mostWanted()
    {
        $mostwanted=Crime::where('is_most_wanted',1)->paginate(10);
        return view('reporter.view_most_wanted',['mostWanted'=>$mostwanted]);
    }


    public function searchMostWanted(Request $request){
        $request->validate([
            'query'=>['required'],
        ]);
        $query = $request->query('query');
    
            $mostWanted = Crime::where('is_most_wanted', 1)
                ->where('name', 'like', '%' . $query . '%')
                ->orWhere('category', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->paginate(10);
            return view('reporter.view_most_wanted', ['mostWanted' => $mostWanted]);
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
    public function destroy($id)
    {
        $crime = Crime::findOrFail($id);

        foreach ($crime->images as $image) {
            Storage::delete('public/crime_images/' . $image->path);
            $image->delete();
        }

        $crime->delete();

        return redirect()->back()->with('success', 'Lost item has been deleted successfully.');
    }
}
