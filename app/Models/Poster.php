<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Tag;
use Illuminate\Http\Request;

class Poster extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable =  [
        'title_en',
        'title_ch',
        'parent_section',
        'sub_section',
        'child_section',
        'tags',
        'description_en',
        'description_ch',
        'status',
        'user_id',
        'slug'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
    
    public $translatable = ['title','description'];


    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
           $model->slug = \Str::uuid()->toString();
           $model->user_id = auth()->user()->id;
        });

        
    }


    public function getTitleAttribute($value)
    {   
        $locale = app()->getLocale();
        $column = "title_{$locale}";
        return $this->{$column};
        //return $this->getTranslation('title', app()->getLocale());
    }

    public function getDescriptionAttribute($value)
    {   
        $locale = app()->getLocale();
        $column = "description_{$locale}";
        return $this->{$column};
        //return $this->getTranslation('description', app()->getLocale());
    }

    public function uploads()
    {
        return $this->morphMany(Uploads::class, 'uploadsable');
    }

    public function userDetails(){
        return $this->hasone("App\Models\User","id","user_id");
    }

    public function parentSection(){
        return $this->hasone("App\Models\Section","id","parent_section");
    }

    public function subSection(){
        return $this->hasone("App\Models\Section","id","sub_section");
    }

    public function childSection(){
        return $this->hasone("App\Models\Section","id","child_section");
    }

    public function episodes(){
        return $this->hasmany("App\Models\Episode","poster_id","id");
    }


    public function reads(){
        return $this->hasmany("App\Models\PosterReadCount","poster_id","id");
    }

    // public function tags()
    // {
    //     return $this->belongsToMany(Tag::class);
    // }

    // public function tags()
    // {
    //     return Tag::whereIn('id', explode(',', $this->tags))->get();
    // }
}
