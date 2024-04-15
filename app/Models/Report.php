<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public function userData(){
        return $this->belongsTo("App\Models\User","id");
    }

    public function PosterData(){
        return $this->hasone("App\Models\Poster","id","poster_id");
    }
}
