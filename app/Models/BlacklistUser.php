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
        'blacklist_tag_id',
        'other_reason',
        'user_id',
        'created_at',
        'updated_at'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function blacklistTag()
    {
        return $this->belongsTo(BlacklistTag::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
