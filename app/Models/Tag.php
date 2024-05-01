<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['name_en', 'name_ch', 'tag_type', 'status'];
    public $translatable = ['name'];

    public function type()
    {
        return  $this->hasone("App\Models\TagType", "id", "tag_type");
    }

    public function getNameAttribute($value)
    {
        $locale = app()->getLocale();
        $column = "name_{$locale}";
        return $this->{$column};
    }

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
