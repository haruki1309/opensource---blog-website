<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect,Response;
use Validator;
use Auth;
use Hash;

class AuthenticationController extends Controller
{
	public function getLoginPage(){
		return view('admin/login');
	}

    public function login(Request $request){
    	if(Auth::attempt( ['username'=>$request->username, 'password'=>$request->password])){
    		return redirect('admin/dashboard');
    	}
    	else{
    		return back();
    	}
    }

    public function logout(){
        Auth::logout();
        return redirect('admin/login');
    }

    public function getAccountPage(){
        $user = Auth::user();
        return view('admin/account', compact('user'));
    }

    public function changeAccountInfo(Request $request){
        $user = Auth::user();

        $this->validate($request, [
            'username'=>'required|min:3|unique:user,username,'.$user->id,
        ] , [
            'username.required'=>'You have not entered username',
            'username.min'=>'Username must have more than 3 character',
            'username.unique'=>'Username already exists',
        ]);

        $user->username = $request->username;
        $user->name = $request->displayname;
        $user->description = $request->description;
        
        if($request->hasFile('imgfile')){
            $file = $request->file('imgfile');

            $namePic = $file->getClientOriginalName();

            $pic = Str::random(4)."_".$user->username."_".$namePic;

            while (file_exists('1309_admin_avt/'.$pic)) {
                $pic = Str::random(4)."_".$namePic;
            }

            $file->move('1309_admin_avt/', $pic);
            $user->img_url = '1309_admin_avt/'.$pic;
        }

        $user->save();
        return back()->with('message', 'Update information successfuly!');
    }

    public function changePassword(Request $request){
        $user = Auth::user();

        if(Hash::check($request->oldpassword, $user->password)){
            if($request->newpassword == $request->confirmpassword){
                $user->password = bcrypt($request->newpassword);
                $user->save();
            }
            else{
                return Response::json('wrong:confirmpassword');
            }
        }
        else{
            return Response::json(Hash::check('wrong:oldpassword'));
        }
        return Response::json('success');
    }
}
