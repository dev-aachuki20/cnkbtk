<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Episode extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable =  [
        'title_en',
        'title_ch',
        'description_en',
        'description_ch',
        'cost',
        'poster_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $translatable = ['title','description'];

    public function getTitleAttribute($value)
    {   
        $locale = app()->getLocale();
        $column = "title_{$locale}";
        return $this->{$column};
        
    }

    public function getDescriptionAttribute($value)
    {   
        $locale = app()->getLocale();
        $column = "description_{$locale}";
        return $this->{$column};
    }

    public function uploads()
    {
        return $this->morphMany(Uploads::class, 'uploadsable');
    }

    public function poster()
    {
        return $this->belongsTo(Poster::class, "poster_id","id");
    }

    
}
