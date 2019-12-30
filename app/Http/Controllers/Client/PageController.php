<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect,Response;
use App\User;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Comment;


class PageController extends Controller
{
    public function getHomepage(){
        $posts = Post::orderBy('id', 'desc')->take(7)->get();
        $tags = Tag::all();
        $categories = Category::all();
        $recents = Post::orderBy('id', 'desc')->take(5)->get();
    	return view('client/home', compact('posts', 'tags', 'recents', 'categories'));
    }

    public function loadmore(Request $request){
        if($request->ajax()){
            $posts = Post::where('id', '<', $request->endID)->orderBy('id', 'DESC')->take(2)->get();
            if(!$posts->isEmpty()){
                $output = [
                    'view'=>view('client/subview/post-element', compact('posts'))->render(), 
                    'end'=>$posts[count($posts) - 1]->id
                ];
            }
        }

        return Response::json($output);
    }

    public function getPost(Request $request, $titleUrl){
    	$post = Post::where('title_url', '=', $titleUrl)->first();
       
        $related = Post::whereHas('tags', function($q) use ($post){
            return $q->whereIn('name', $post->tags->pluck('name'));
        })->where('id', '!=', $post->id)->take(5)->get();

        $recents = Post::orderBy('updated_at', 'desc')->take(5)->get();

        $comments = Comment::where(['post_id'=>$post->id, 'parent_id'=>null, 'moderated'=>1])->get();

        if(!$request->session()->has('post/'.$titleUrl)){
            $post->increment('views');
            $request->session()->put('post/'.$titleUrl, 'visited');
        }

    	return view('client/post', compact('post', 'related', 'recents', 'comments'));
    }

    public function getAboutsPage(){
        $postsCount = count(Post::all());
        $categoriesCount = count(Category::all());
        $userCount = count(User::all());
        $viewsCount = Post::all()->sum('views');

    	return view('client/about', compact('postsCount', 'categoriesCount', 'userCount', 'viewsCount'));
    }
}
