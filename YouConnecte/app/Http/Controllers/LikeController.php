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
        return '  <div class="like-icon" onclick="deletLike(\'' . $publication->id . '\')" id="' . $publication->id . '">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="red" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            <i>' . $publication->like->count() . '</i>
        </div>';
        
    }

    public function delete($id)
    {

        $like = Like::where('pub_id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();
        $like->delete();
        $publication = Publication::find($id);
        return '  <div class="like-icon" onclick="addLike(\'' . $publication->id . '\')" id="' . $publication->id . '">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            <i>' . $publication->like->count() . '</i>
        </div>';
    }
}
