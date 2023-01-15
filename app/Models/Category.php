<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function PostCount()
    {
        return $this->hasMany('App\Models\Posts','category_id','id')->count();
    }
}
