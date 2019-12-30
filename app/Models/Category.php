<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Category extends Model
{
    protected $table = "category";
    protected $fillable = ['name', 'name_url'];

    public function posts(){
    	return $this->hasMany('App\Models\Post');
    }
}
