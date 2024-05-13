<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $user_type='Reporters';
        $users = User::where('role','reporter')->paginate(10);
        return view('admin.users',['users'=>$users,'user_type'=>$user_type]);
    }

    public function show()
    {
        $user_type='Officers';
        $users = User::where('role','officer')->paginate(10);
        return view('admin.users',['users'=>$users,'user_type'=>$user_type]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.register_officer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "first_name"=>['required','string'],
            "last_name"=>['required','string'],
            "email"=>['required','email','unique:users,email'],
        ]);
        $password=null;
        $rawpass=null;
        
        $rawpass=strtoupper($request->last_name);
        $password=Hash::make(strtoupper($request->last_name));
        
        
        $user=User::create([
            'username'=>Str::uuid(),
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=>$password,
            'role'=>$request->role,
        ]);

        /**you can send an email to the registered
         *  user here with username and password
         * 
    
        Mail::to($user->email)->send(new WelcomeEmail($user, $rawpass));
        /*self registration*/

    

        /*registered by admin*/
        return back()->with('success',
        'User registered successfully. Use your last name in uppercase as password');

    }

    public function search(Request $request){
        $request->validate([
            'query'=>['required'],
        ]);
    
        $query = $request->query('query');
    
        if(strtolower($request->user_type) === "reporters"){
            $user_type = "Reporters";
            $users = User::where('role', 'reporter')
                ->where('first_name', 'like', '%' . $query . '%')
                ->orWhere('last_name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->paginate(10);
            return view('admin.users', ['users' => $users, 'user_type' => $user_type]);
        } else {
            $user_type = "Officers";
            $users = User::where('role', 'officer')
                ->where('first_name', 'like', '%' . $query . '%')
                ->orWhere('last_name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->paginate(10);
            return view('admin.users', ['users' => $users, 'user_type' => $user_type]);
        }
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
    public function destroy($email){
        $user = User::where('email', $email)->first();
        $user->delete();

        return back()->with('info', 'User deleted successfully');
    }
}