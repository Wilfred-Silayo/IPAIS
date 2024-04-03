<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistrationRequest $request)
    { 
        $password=null;
        $rawpass=null;
        /*registered by admin*/
        if(!$request->has('password')){
            $rawpass=strtoupper($request->last_name);
            $password=Hash::make(strtoupper($request->last_name));
        }
        /*self registration*/

        $password=Hash::make($request->password);
        $rawpass=$request->password;

        $user=User::create([
            'username'=>$request->username,
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

        if(!Auth::check()){
            Auth::login($user);

            return redirect()->route('dashboard');
            
        }

        /*registered by admin*/
        return back()->with('success',
        'User registered successfully. Use your last name in uppercase as password');

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