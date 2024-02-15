<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;


class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publications = Publication::all();
        return view('accueil', compact('publications'));
    
    }

    public function getPublicationUser()
    {
        $publications = Publication::where("user_id",session('user_id'))
        ->get();
        return view('Publication', compact('publications'));
    }
  
    public function create()
    {
        $publications = Publication::where("user_id", session('user_id'))
        ->get();
        return view('profile', compact('publications'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request  $request)
    {
        //
        $request->validate([
            'content' => 'required',
        ]);
        $publication = Publication::create([
            'content' => $request->content,
            'user_id' => session('user_id'),
            // session('user_id')
        ]);
            if( $publication){
                return redirect()->back()
                ->with('success', 'Publication created successfully.');
            }
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(string $id)
    {
        $publication = Publication::findOrFail($id);
        return view('formJion', compact('publication'));
    }
    public function update(Request $request,string $id)
    {
        //


        $request->validate([
            'content' => 'required',
        ]);
        
        $publication = Publication::findOrFail($id);
        $publication->update($request->all());
        return redirect()->back()
        ->with('success', 'Publication updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publication = Publication::findOrFail($id);
        $publication->delete();

        return redirect()->back()
            ->with('success', 'Publication deleted successfully.');
    }

    public function ShowPoste($id)
    {
        $publication = Publication::find($id);
        return view('poste', compact('publication'));
    }
}
