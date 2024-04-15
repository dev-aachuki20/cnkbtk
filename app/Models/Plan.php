<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public function getTitleAttribute($value)
    {   
        $locale = app()->getLocale();
        $column = "title_{$locale}";
        return $this->{$column};
    }


}
