<?php

namespace App\Http\Controllers;

use App\Models\Commeter;
use Illuminate\Http\Request;

class CommeterController extends Controller
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
            'content' => 'required',
        ]);
        $comment = Commeter::create([
            'content' => $request->content,
            'user_id' => session('user_id'),
            'pub_id'=> $id,
        ]);
            if($comment){
                return redirect()->back()
                ->with('success', 'Publication created successfully.');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Commeter $commeter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commeter $commeter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commeter $commeter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Commeter::findOrFail($id);
        $comment->delete();

        return redirect()->back();
    }
}
