<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable =  [
        'user_id',
        'poster_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];


}
