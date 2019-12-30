<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function getPostManage(){
    	$posts = Post::all();
    	return view('admin/postmanage', compact('posts'));
    }

    public function getWritePage(){
    	$tags = Tag::all();
        $categories = Category::all();

    	return view('admin/createpost', compact('tags', 'categories'));
    }

    public function storePost(Request $request){
    	$this->validate($request, [
            'title'=>'required|min:3|unique:post,title',
            'category'=>'required',
            'description'=>'required',
            'content'=>"required"
        ] , [
            'title.required'=>'You have not entered title',
            'title.min'=>'Title must have at least 3 characters',
            'title.unique'=>'Title alrealy exist',
            'category.required'=>'You have not selected category',
            'description.required'=>'You have not entered description',
            'content.required'=>'You have not wrote content'
        ]);

    	$post = new Post();
    	$post->title = $request->title;
        $post->title_url = utf8tourl(utf8convert($request->title));
        $post->category_id = $request->category;
    	$post->content = $request->content;
        $post->description = $request->description;
    	$post->views = 0;
        $post->img_url = '';

        if($request->hasFile('imgfile')){
            $file = $request->file('imgfile');

            $namePic = $file->getClientOriginalName();

            $pic = Str::random(4)."_".$namePic;

            while (file_exists('1309_post_img/'.$post->title_url.'/'.$pic)) {
                $pic = Str::random(4)."_".$namePic;
            }

            $file->move('1309_post_img/'.$post->title_url.'/', $pic);
            $post->img_url = '1309_post_img/'.$post->title_url.'/'.$pic;
        }

    	$post->save();

    	$post->tags()->sync($request->tags, false);

    	return back()->with('message', 'Create new post successfuly!');
    }

    public function getEditPost($id){
    	$post = Post::find($id);
    	$tags = Tag::all();
        $categories = Category::all();

    	return view('admin.editpost', compact('post', 'tags', 'categories'));
    }

    public function storeEdit(Request $request, $id){
    	$this->validate($request, [
            'title'=>'required|min:3|unique:post,title,'.$id,
            'category'=>'required',
            'description'=>'required',
            'content'=>"required"
        ] , [
            'title.required'=>'You have not entered title',
            'title.min'=>'Title must have at least 3 characters',
            'title.unique'=>'Title alrealy exist',
            'category.required'=>'You have not selected category',
            'description.required'=>'You have not entered description',
            'content.required'=>'You have not wrote content'
        ]);

    	$post = Post::find($id);

    	$post->title = $request->title;
        $post->title_url = utf8tourl(utf8convert($request->title));
        $post->description = $request->description;
    	$post->content = $request->content;
        $post->category_id = $request->category;

        if($request->hasFile('imgfile')){
            $file = $request->file('imgfile');

            $namePic = $file->getClientOriginalName();

            $pic = Str::random(4)."_".$namePic;

           while (file_exists('1309_post_img/'.$post->title_url.'/'.$pic)) {
                $pic = Str::random(4)."_".$namePic;
            }

            $file->move('1309_post_img/'.$post->title_url.'/', $pic);

            //unlink("Asset/".$post->picture[0]->HinhAnh);

            $post->img_url = $pic;
        }

    	$post->save();

    	$post->tags()->detach();
    	$post->tags()->sync($request->tags, false);

    	return back()->with('message', 'Edit post successfuly!');
    }

    public function search(Request $request){
        if($request->searchkey === ""){
            return back();
        }
        
        $posts = Post::where('title', 'like', "%$request->searchkey%")->get();

        return view('admin/postmanage', compact('posts'));
    }
}
