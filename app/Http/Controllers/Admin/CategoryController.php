<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect,Response;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function index(){
        $viewName = "thể loại";
        if(request()->ajax()) {
            $categories = Category::all();

            return datatables()->of($categories)
            ->addColumn('action', function($categories){
                $id = $categories->id;
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
        $category = Category::find($id);
        return Response::json($category);
    }

    public function store(Request $request)
    {  
        $data = Category::updateOrCreate(['id'=>$request->id], ['name'=>$request->name, 'name_url'=>utf8tourl(utf8convert($request->name))]);   
        return Response::json($data);
    }

    public function delete($id){
        $Category = Category::where('id', '=', $id)->first();

        if(count($Category->posts) > 0){
            return Response::json("error");
        }
        $Category->delete();
        return Response::json("success");  
    }
}
