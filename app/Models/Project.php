<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "title",
        "type",
        "tags_id",
        "comment",
        "status",
        'project_status',
        "user_id",
        "user_ip",
        "copyright",
        "remark",
        "finish_status",
        "budget",
        'deleted_at',
    ];

    public function creators()
    {
        return $this->belongsToMany(User::class, 'project_creator', 'project_id', 'creator_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsTo(Tag::class);
    }
}
