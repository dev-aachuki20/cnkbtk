<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlacklistUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'ip_address',
        'created_at',
        'updated_at'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
