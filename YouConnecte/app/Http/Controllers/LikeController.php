<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Notification;
use App\Models\Publication;


class LikeController extends Controller
{
    public function store($id)
    {
        $publication = Publication::find($id);
        Like::create([
            'pub_id' => $id,
            'user_id' => session('user_id'),
        ]);
        if ($publication->user_id != session('user_id')) {
            Notification::create([
                'user_id' => $publication->user_id,
                'content' =>  session('user_name') . 'a like your prost',
                'user_id_inf' => session('user_id'),

            ]);
        }
        return view('likeJoin', compact('publication'));
    }

    public function delete($id)
    {

        $like = Like::where('pub_id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();
        $like->delete();
        $publication = Publication::find($id);
        return view('likeJoin', compact('publication'));
    }
}
