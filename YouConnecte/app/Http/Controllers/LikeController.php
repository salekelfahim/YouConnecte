<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function index()
    {
    }
    public function store($id)
    {
        
        Like::create([
            'pub_id' => $id,
            'user_id' => session('user_id'),
        ]);
    }

    public function delete($id)
    {
        $like = Like::where('pub_id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();
        $like->delete();
    }
}
