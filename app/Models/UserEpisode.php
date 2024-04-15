<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEpisode extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "poster_id",
        "episode_id",
        "points",
        "episode_title"
    ];
}
