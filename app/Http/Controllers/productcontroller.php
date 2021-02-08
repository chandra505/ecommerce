<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\cart;
use Session;
class productcontroller extends Controller
{
    function index(){
        $data=product::all();

        return view('product',['products'=>$data]);
    }
    function detail($id){
       $data= product::find($id);
       return View('detail',['product'=>$data]);
    }
    function search(Request $req){
        
        $data=product::where('name',$req->input('query'))->get();
        return view('search',['products'=>$data]);
    }
    function addtocart(Request $req){
        if($req->session()->has('user')){
            $cart=new cart;
            $cart->user_id=$req->session()->get('user')['id'];
            $cart->product_id=$req->product_id;
            $cart->save();
            return redirect('/');
        }else{
            return redirect('/login');
        }
        
    }
  static function cartitem(){
            $userid=session::get('user')['id'];
            return cart::where('user_id',$userid)->count();
    }
}
