<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlacklistTag extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name_en',
        'name_ch',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function blacklistUsers()
    {
        return $this->hasMany(BlacklistUser::class);
    }
}
