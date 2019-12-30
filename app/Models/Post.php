<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;

class Post extends Model
{
    protected $table = "post";
    protected $fillable = ['title, content', 'views'];

    public function tags(){
    	return $this->belongsToMany('App\Models\Tag');
    }

    public function category(){
    	return $this->belongsTo('App\Models\Category');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
}
