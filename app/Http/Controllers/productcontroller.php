<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\cart;
use App\Models\order;
use Session;
use Illuminate\Support\Facades\DB;
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
    function cartlist(){
        $userid=session::get('user')['id'];
        $products=DB::table('cart')
        ->join('products','cart.product_id',"=",'products.id')
        ->where('cart.user_id',$userid)
        ->select('products.*','cart.id as cart_id')
        ->get();
        return View('cartlist',['products'=>$products]);
    }
    function removecart($id){
        cart::destroy($id);
        return redirect('cartlist');
    }
    function ordernow(){
        $userid=session::get('user')['id'];
        $total= $products=DB::table('cart')
        ->join('products','cart.product_id',"=",'products.id')
        ->where('cart.user_id',$userid)
        ->select('products.*','cart.id as cart_id')
        ->sum('products.price');
        return View('ordernow',['total'=>$total]);
    }
    function orderplace(Request $req){
        $userid=session::get('user')['id'];
         $allcart=cart::where('user_id',$userid)->get();
    
    foreach($allcart as $cart)
    {
        $order=new order;
        $order->product_id=$cart['product_id'];
        $order->user_id=$cart['user_id'];
        $order->status="pending";
        $order->payment_method=$req->payment;
        $order->payment_status="pending";
        $order->address=$req->address;
        $order->save();
        cart::where('user_id',$userid)->delete();
    }
    return redirect('/');
    }
    function myorders(){
        $userid=session::get('user')['id'];
        $orders= DB::table('orders')
        ->join('products','orders.product_id',"=",'products.id')
        ->where('orders.user_id',$userid)
        ->get();
        return View('myorders',['orders'=>$orders]);
    }
}
