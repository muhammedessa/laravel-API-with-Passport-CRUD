<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use  Validator ;

use Illuminate\Support\Facades\Auth;  //added


class RegisterController extends BaseController  
{

 

public function register(Request $request)
{
    # code...
   
    $validator =    Validator::make($request->all(), [
    'name'=> 'required',
    'email'=> 'required|email',
    'password'=> 'required',
    'c_password'=> 'required|same:password',
    ] );

    if ($validator -> fails()) {
        # code...
        return $this->sendError('error validation', $validator->errors());
    }

    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    $success['token'] = $user->createToken('MyApp')->accessToken;
    $success['name'] = $user->name;

    return $this->sendResponse($success , 'User created succesfully');
    
}

 

    
}

