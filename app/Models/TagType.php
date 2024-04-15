<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TagType extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['name_en','name_ch','status'];
    public $translatable = ['name'];
    
    public  function tags(){
        return $this->hasmany("App\Models\Tag","tag_type","id");
    }

    public function getNameAttribute($value)
    {   
        $locale = app()->getLocale();
        $column = "name_{$locale}";
        return $this->{$column};
    }
}
