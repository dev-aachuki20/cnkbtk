<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'subject',
        'email_body',
        'status',
        'created_at',
        'updated_at'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    
}
