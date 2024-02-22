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
        if($user->id != session('user_id')){
            Notification::create([
                'user_id' =>$user->id ,
                'content' =>  session('user_name').'a like your prost',
                'user_id_inf' =>session('user_id'),
    
            ]);
        }
    
    }

    public function delete($id)
    { 
        $abonne =  Abonne::where('following_id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();
        $abonne->delete();
    }
}
