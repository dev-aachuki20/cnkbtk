<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniqueVisitor extends Model
{
    use HasFactory;
    protected $fillable = ['ip_address','date', 'device_name'];
}
