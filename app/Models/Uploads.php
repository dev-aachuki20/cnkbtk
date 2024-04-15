<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploads extends Model
{
    use HasFactory;

    protected $appends = ['name', 'file_url', 'size'];

    protected $fillable = ['path', 'type'];

    /**
     * Get name attribute  
     */
    public function getNameAttribute()
    {
        return substr($this->path, strpos($this->path, "/") + 1);
    }

    /**
     * Get size attribute  
     */
    public function getSizeAttribute()
    {
        try {
            if ($this->path && \Storage::disk('public')->exists($this->path)) {
                return \File::size(public_path('storage/' . $this->path));
            }
        } catch (Exception $e) {
            return 0;
        }
        return 0;
    }

    /**
     * Get file url attribute  
     */
    public function getFileUrlAttribute()
    {
        $MediaImage = '';
        if ($this->path && \Storage::disk('public')->exists($this->path)) {
            $MediaImage = asset('storage/' . $this->path);
        }
        return $MediaImage;
    }

    /**
     * Get all of the models that own uploads.
     */
    public function uploadsable()
    {
        return $this->morphTo();
    }
}
