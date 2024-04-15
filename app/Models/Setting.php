<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'label',
        'value',
        'type',
        'options',
        'restrictions',
        'status',
    ];
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'options' => 'json',
        'restrictions' => 'json',
    ];
}
