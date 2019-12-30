<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Models\Post;

class Comment extends Model
{
    protected $table = "comment";
    protected $fillable = ['username, subject', 'comment'];

    public function post(){
        return $this->belongsTo('App\Models\Post');
    }

    public function parent(){
        return $this->belongsTo('App\Models\Comment', 'parent_id');
    }

    public function children(){
        return $this->hasMany('App\Models\Comment', 'parent_id');
    }

}
