<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCreators extends Model
{
    use HasFactory;
    protected $table = 'project_creators';
    protected $fillable = [
        'project_id',
        'creator_id',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }
}
