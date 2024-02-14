<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Publications = Publication::all();
        return view('Publication', compact('Publications'));
    }

    public function getPublicationUser()
    {
        $Publications = Publication::where("user_id",session('user_id'))
        ->get();
        return view('Publication', compact('Publications'));
    }
  

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePublicationRequest $request)
    {
        //
        $request->validate([
            'content' => 'required',
        ]);
        $Publication = Publication::create([
            'content' => $request->content,
            'user_id' => session('user_id'),
        ]);

        return redirect()->back()
            ->with('success', 'Publication created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePublicationRequest $request,string $id)
    {
        //
        $request->validate([
            'content' => 'required',
        ]);
        
        $Publication = Publication::findOrFail($id);
        $Publication->update($request->all());

        return redirect()->back()
            ->with('success', 'Publication updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Publication = Publication::findOrFail($id);
        $Publication->delete();

        return redirect()->back()
            ->with('success', 'Publication deleted successfully.');
    }
}
