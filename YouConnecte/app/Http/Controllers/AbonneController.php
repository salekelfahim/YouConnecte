<?php

namespace App\Http\Controllers;

use App\Models\Abonne;
use App\Models\User;
use App\Models\Notification;


class AbonneController extends Controller
{
    public function store($id)
    {
        $user = User::findOrFail($id);
        Abonne::create([
            'following_id' => $id,
            'user_id' => session('user_id'),
        ]);
    
        if ($user->id != session('user_id')) {
            Notification::create([
                'user_id' => $user->id,
                'content' => session('user_name') . 'a like your post',
                'user_id_inf' => session('user_id'),
            ]);
        }
    
        return '<div class="like-icon" onclick="nf(\'' . $user->id . '\')">
        <button class="btn btn-light btn-sm bg-white has-icon btn-block" type="button">
            Following</button>
    </div>';
    }
    
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $abonne = Abonne::where('following_id', $id)
            ->where('user_id', session('user_id'))
            ->delete();
    
            return '<div class="like-icon" onclick="f(\'' . $user->id . '\')">
            <button class="btn btn-light btn-sm bg-white has-icon btn-block" type="button">
                <i class="material-icons">add</i>Follow</button>
        </div>';
    }
}
