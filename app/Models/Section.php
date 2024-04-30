<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Section extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'name_en',
        'name_ch',
        'parent_id',
        'description_en',
        'description_ch',
        'section_logo',
        'creator_can_post',
        'level',
        'status',
        'created_at',
        'updated_at'
    ];

    public $translatable = ['name','description'];

    public function getNameAttribute($value)
    {   
        $locale = app()->getLocale();
        $column = "name_{$locale}";
        return $this->{$column};
    }

    public function getDescriptionAttribute($value)
    {   
        $locale = app()->getLocale();
        $column = "description_{$locale}";
        return $this->{$column};
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function($model){
           $model->slug = \Str::uuid()->toString();
        });

        self::updating(function($model){
            if(empty($model->slug)){
                $model->slug = \Str::uuid()->toString();
            }
         });
    }

    public function parent_category()
    {
        return $this->hasone('App\Models\Section','id','parent_id');
    }

    public function subSections()
    {
        return $this->hasMany(Section::class, 'parent_id', 'id')->where("status",1);
    }

    public function uploads()
    {
        return $this->morphMany(Uploads::class, 'uploadsable');
    }
    
    public function parentSectionPosters(){
        return $this->hasMany('App\Models\Poster','parent_section','id');
    }

    public function subSectionPosters(){
        return $this->hasMany('App\Models\Poster','sub_section','id');
    }

    // public function childSectionPosters(){
    //     return $this->hasMany('App\Models\Poster','child_section','id');
    // }

    


}
