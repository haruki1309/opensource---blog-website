<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect,Response;
use Validator;

use App\Models\Subscriber;

class SubscribeController extends Controller
{
    public function subscribe(Request $request){
        //validate unique subcriber's email
        $input = array('email'=>$request->email);
        $rules = array('email'=>'unique:subcriber,email');
        $validator = Validator::make($input, $rules);

        if($validator->passes()){
            $subscriber = new Subscriber();
            $subscriber->email = $request->email;
            $subscriber->save();
        }

        return Response::json($request->email);
    }
}
