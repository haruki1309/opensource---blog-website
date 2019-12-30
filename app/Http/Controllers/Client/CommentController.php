<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect,Response;
use Validator;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Subscriber;

class CommentController extends Controller
{
    public function comment(Request $request, $titleUrl){
        $post = Post::where('title_url', $titleUrl)->first();

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->username = $request->name;
        $comment->subject = $request->subject;
        $comment->comment = $request->message;
        $comment->save();

        //validate unique subcriber's email
        $input = array('email'=>$request->email);
        $rules = array('email'=>'unique:subscriber,email');
        $validator = Validator::make($input, $rules);

        if($validator->passes()){
            $subscriber = new Subscriber();
            $subscriber->email = $request->email;
            $subscriber->save();
        }

        return Response::json("success");
    }

    public function replycomment(Request $request, $titleUrl, $commentID){
        $post = Post::where('title_url', $titleUrl)->first();

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->parent_id = $commentID;
        $comment->username = $request->name;
        $comment->subject = $request->subject;
        $comment->comment = $request->message;
        $comment->save();

        //validate unique subcriber's email
        $input = array('email'=>$request->email);
        $rules = array('email'=>'unique:subscriber,email');
        $validator = Validator::make($input, $rules);

        if($validator->passes()){
            $subscriber = new Subscriber();
            $subscriber->email = $request->email;
            $subscriber->save();
        }

        return Response::json("success");
    }
}
