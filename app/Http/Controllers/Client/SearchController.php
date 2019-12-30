<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;


class SearchController extends Controller
{
    public function getTagAchive($name){
    	$tag = Tag::where('name_url', $name)->first();
        $resultname = "Tag Archives: ".$tag->name;
        $posts = $tag->posts;

        $tags = Tag::all();
        $recents = Post::orderBy('updated_at', 'desc')->take(5)->get();
    	
    	return view('client\searchresult', compact('resultname', 'recents', 'posts', 'tags'));
    }

    public function getCategoryPosts($name){
        $category = Category::where('name_url', $name)->first();
        $resultname = $category->name;
    	$posts = $category->posts;

    	$tags = Tag::all();
        $recents = Post::orderBy('updated_at', 'desc')->take(5)->get();

    	return view('client\searchresult', compact('resultname', 'recents', 'posts', 'tags'));
    }

    public function search(Request $request){
        if($request->searchkey === ""){
            return back();
        }
        $tags = Tag::all();
        $recents = Post::orderBy('updated_at', 'desc')->take(5)->get();
        $resultname = $request->searchkey." - kết quả tìm kiếm";
        $posts = Post::where('title', 'like', "%$request->searchkey%")->get();

        return view('client/searchresult', compact('posts', 'resultname', 'tags', 'recents'));
    }
}
