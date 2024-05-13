<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=User::where('username',Auth::user()->username)->first();
        return view('profile.index',['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user=User::where('username',Auth::user()->username)->first();
        return view('profile.edit',['user'=>$user]);   
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
    
        // Define validation rules
        $rules = [
            "first_name" => ['required', 'string'],
            "last_name" => ['required', 'string'],
            "address" => ['nullable', 'string'],
            "dob" => ['nullable', 'date'],
            "profile_image" => ['nullable', 'image', 'mimes:jpg,jpeg,bmp,png'],
        ];
    
        // If the email is being changed, add uniqueness validation rule
        if ($request->input('email') !== $user->email) {
            $rules['email'] = ['required', 'email', 'unique:users'];
        } else {
            // If email is not being changed, remove uniqueness validation rule
            $rules['email'] = ['required', 'email'];
        }
    
        // Validate request data
        $request->validate($rules);
    
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image');
            $profileImageName = time() . '_' . $profileImage->getClientOriginalName();
            $profileImage->storeAs('public/profile_images', $profileImageName); // Store the image in the storage folder
            $user->profile_image = $profileImageName; // Save the image name to the user's profile
        }
    
        // Update user fields
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->dob = $request->input('dob');
    
        /** @var User $user */
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $email=Auth::user()->email;
        $user = User::where('email', $email)->first();
        $user->delete();

        return redirect("/")->with('info', 'User account deleted successfully. Welcome again!');
    }
}