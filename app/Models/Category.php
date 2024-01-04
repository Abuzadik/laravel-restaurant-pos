<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function menu(){
        return $this->hasMany(foodmenu::class);
    }
    use HasFactory;
}
