<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\user;
class usercontroller extends Controller
{
    function login(Request $req){
        $user= user::where(['email'=>$req->email])->first();
        if($user || $Hash::check($req->password,$user->password)){
            $req->session()->put('user',$user);
            return redirect('/');

        }else{
            return'username or password is  not matched';
        }
    }
    function Register(Request $req){
        // return $req->input();
        $user=new user;
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->save();
       return redirect('/login');
    }
}
