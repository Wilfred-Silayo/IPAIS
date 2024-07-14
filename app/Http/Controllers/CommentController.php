<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Crime;
use App\Models\LostItem;
use Illuminate\Http\Request;

class CommentController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'content'=>'required|string',
            'user_id'=>'required',
            'is_most_wanted'=>'required',
        ]);

        Comment::create([
            'content'=>$request->content,
            'post_id'=>$id,
            'is_most_wanted'=>$request->is_most_wanted,
            'user_id'=>$request->user_id,
        ]);

        return back()->with('success','Comment posted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = LostItem::findOrFail($id);
        $comments=Comment::where('post_id',$id)->where('is_most_wanted',0)->paginate(10);

        return view('comments',['comments'=>$comments,'lostItem'=>$post,'type'=>1]);
    }

    public function showMostWanted($id)
    {
        $post = Crime::findOrFail($id);
        $comments=Comment::where('post_id',$id)->where('is_most_wanted',1)->paginate(10);

        return view('comments',['comments'=>$comments,'lostItem'=>$post,'type'=>2]);
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