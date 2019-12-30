<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect,Response;

use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function index(){
        return view('admin/comments');
    }

    public function unmoderatedComment(){
        if(request()->ajax()) {
            $comments = DB::table('comment')
                    ->join('post', 'comment.post_id', '=', 'post.id')
                    ->select(DB::raw('post.title as posttitle, comment.*'))
                    ->where('moderated', 0)
                    ->get();

            return datatables()->of($comments)
            ->addColumn('action', function($comments){
                $id = $comments->id;
                return (string)view('admin/action/accept-delete', compact('id'));
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function moderatedComment(){
        if(request()->ajax()) {
            $comments = DB::table('comment')
                    ->join('post', 'comment.post_id', '=', 'post.id')
                    ->select(DB::raw('post.title as posttitle, comment.*'))
                    ->where('moderated', 1)
                    ->get();

            return datatables()->of($comments)
            ->addColumn('action', function($comments){
                $id = $comments->id;
                return (string)view('admin/action/accept-delete', compact('id'));
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
    }

    public function edit($id)
    {   
        $comment = Comment::where('id', '=', $id)->first();
        $comment->moderated = true;
        $comment->save();

        return Response::json("success");
    }

    public function delete($id){
        $comment = Comment::where('id', '=', $id)->first();
        $comment->delete();
        return Response::json("success");  
    }
}
