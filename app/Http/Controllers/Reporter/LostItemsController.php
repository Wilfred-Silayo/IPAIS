<?php

namespace App\Http\Controllers\Reporter;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LostItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username=Auth::user()->username;
        $lost_items=LostItem::where('reported_by',$username)->paginate(10);
        return view('reporter.report_lost_items',['lostItems'=>$lost_items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reporter.create_lost_item');
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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each uploaded image
        ]);

        // Store the crime details in the database
        $lostItem = new LostItem();
        $lostItem->name = $validatedData['name'];
        $lostItem->category = $validatedData['category'];
        $lostItem->location = $validatedData['location'];
        $lostItem->description = $validatedData['description'];
        $lostItem->date_reported =now();
        $lostItem->reported_by = auth()->user()->username;
        $lostItem->save();

        // Upload and store the images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/lostItem_images', $imageName); 

                $imageModel= new Image();
                $imageModel->path=$imageName;
                $imageModel->lost_item_id =$lostItem->id;  
                $imageModel->save();              
            }
        }

        // Redirect the user back with a success message
        return redirect()->route('reporter.report.lost.items')->with('success', 'lost item reported successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $lost_items=LostItem::paginate(10);
        return view('reporter.view_lost_items',['lostItems'=>$lost_items]);
        
    }

    public function search(Request $request){
        $request->validate([
            'query'=>['required'],
        ]);
        $username=Auth::user()->username;
        $query = $request->query('query');
    
    
            $lostItems = LostItem::where('reported_by', $username)
                ->where('name', 'like', '%' . $query . '%')
                ->orWhere('category', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->paginate(10);
            return view('reporter.report_lost_items', ['lostItems' => $lostItems]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    

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
        $lostItem = LostItem::findOrFail($id);

        foreach ($lostItem->images as $image) {
            Storage::delete('public/lostItem_images/' . $image->path);
            $image->delete();
        }

        $lostItem->delete();

        return redirect()->back()->with('success', 'Lost item has been deleted successfully.');
    }

}
