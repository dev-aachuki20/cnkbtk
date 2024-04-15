<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Advertisement extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['image_en','image_ch','advertisement_type','url','status'];
    public $translatable = ['image'];

    public function getImageAttribute($value)
    {   
        $locale = app()->getLocale();
        $column = "image_{$locale}";
        return $this->{$column};
    }

}
