<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        "type",
        "tags",
        "comment",
        "user_id",
        "user_ip",
        "copyright",
        "creator_id",
        "budget",
    ];
}
