<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commeter extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'pub_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function publication()
    {
        return $this->belongsTo(Publication::class, 'pub_id');
    }
}
