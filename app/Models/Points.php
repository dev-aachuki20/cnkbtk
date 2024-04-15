<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "plan_id",
        "credit",
        "debit",
        "amount",
        "available_integral_point",
        "available_general_point",
        "post_id",
        "episode_id",
        "type",
        "creator_id",
        "status",
        "payment_id",
        "created_at",
        "updated_at"
    ];

    public function plan(){
        return $this->hasone("App\Models\Plan","id","plan_id");
    }
     
}
