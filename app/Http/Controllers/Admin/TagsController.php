<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect,Response;
use App\Models\Tag;
use App\Models\Post;

class TagsController extends Controller
{
    public function index(){
        $viewName = "nhãn";
        if(request()->ajax()) {
            $tags = Tag::all();

            return datatables()->of($tags)
            ->addColumn('action', function($tags){
                $id = $tags->id;
                return (string)view('admin/action/edit-delete', compact('id'));
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin/post-info', compact('viewName'));
    }

    public function edit($id)
    {   
        $tag = Tag::find($id);
        return Response::json($tag);
    }

    public function store(Request $request)
    {  
        $data = Tag::updateOrCreate(['id'=>$request->id],['name'=>$request->name, 'name_url'=>utf8tourl(utf8convert($request->name))]);   
        return Response::json($data);
    }

    public function delete($id){
        $tag = Tag::where('id', '=', $id)->first();

        if(count($tag->posts) > 0){
            return Response::json("error");
        }
        $tag->delete();
        return Response::json("success");  
    }
}
