<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Tag extends Model
{
    protected $table = "tag";
    protected $fillable = ['name', 'name_url'];

    public function posts(){
    	return $this->belongsToMany('App\Models\Post');
    }
}
