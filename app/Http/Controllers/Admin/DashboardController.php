<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;

class DashboardController extends Controller
{
    public function getDashboard(){ 
    	$totalPosts = count(Post::all());
    	$totalViews = 0;

    	foreach(Post::all() as $post){
    		$totalViews += $post->views;
    	}

    	$mostInteratedPost = Post::orderBy('views', 'DESC')->get();

    	$popularCategory = DB::table('category')
                    ->join('post', 'category.id', '=', 'post.category_id')
                    ->select(DB::raw('sum(post.views) as repetition, category.name'))
                    ->groupBy('category.id', 'category.name')
                    ->orderBy('repetition', 'desc')
                    ->take(3)
                    ->get();

    	return view('admin/dashboard', compact('totalViews', 'totalPosts', 'mostInteratedPost', 'popularCategory'));
    }
}
