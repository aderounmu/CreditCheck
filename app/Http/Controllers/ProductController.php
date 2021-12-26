<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Wallet;
use App\Models\User;

use Session;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    //
    function index()
    {
        $data= Product::all();

       return view('product',['products'=>$data]);
    }
    function detail($id)
    {
        $data =Product::find($id);
        return view('detail',['product'=>$data]);
    }
    function search(Request $req)
    {
        $data= Product::
        where('name', 'like', '%'.$req->input('query').'%')
        ->get();
        return view('search',['products'=>$data]);
    }
    function addToCart(Request $req)
    {
        if($req->session()->has('user'))
        {
           $cart= new Cart;
           $cart->user_id=$req->session()->get('user')['id'];
           $cart->product_id=$req->product_id;
           $cart->save();
           return redirect('/');

        }
        else
        {
            return redirect('/login');
        }
    }
    static function cartItem()
    {
     $userId=Session::get('user')['id'];
     return Cart::where('user_id',$userId)->count();
    }
    function cartList()
    {
        if (isset(Session::get('user')['id']) && !empty(Session::get('user')['id'])) {
            $userId=Session::get('user')['id'];
        }else{
            return redirect('/');
        }
            
        
       $products= DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->select('products.*','cart.id as cart_id')
        ->get();

        return view('cartlist',['products'=>$products]);
    }
    function removeCart($id)
    {
        Cart::destroy($id);
        return redirect('cartlist');
    }
    function orderNow()
    {
        $userId=Session::get('user')['id'];
        $total= $products= DB::table('cart')
         ->join('products','cart.product_id','=','products.id')
         ->where('cart.user_id',$userId)
         ->sum('products.price');
         $wallet = User::find($userId)->wallet;
         $wallet_limit = $wallet->wallet_limit;
 
         return view('ordernow',['total'=>$total, 'credit_limit' => $wallet_limit ]);
    }
    function orderPlace(Request $req)
    {
        $myerror = [
            'isError' => false,
            'Message' => ''
        ];
        $userId=Session::get('user')['id'];
        $allCart= Cart::where('user_id',$userId)->get();
        $wallet = User::find($userId)->wallet;
        $wallet_limit = $wallet->wallet_limit;
        $total= $products= DB::table('cart')
            ->join('products','cart.product_id','=','products.id')
            ->where('cart.user_id',$userId)
            ->sum('products.price');
         //check if address to set
         if(empty($req->address) || !isset($req->address)){
            $myerror['isError'] = true;
            $myerror['Message'] = "address is required";
            
            return view('ordernow',['total'=>$total,'credit_limit' => $wallet_limit, 'myerror' => $myerror]);
         }

         //checking is the payment is set 
         if(empty($req->payment) || !isset($req->payment)){
            $myerror['isError'] = true;
            $myerror['Message'] = "payment is required";
            
            
            return view('ordernow',['total'=>$total,'credit_limit' => $wallet_limit, 'myerror' => $myerror]);
         }

         //make sure the total

        if( $wallet->wallet_limit <= $total ){
            $myerror['isError'] = true;
            $myerror['Message'] = "The total is more than your credit limit";
            return view('ordernow',['total'=>$total,'credit_limit' => $wallet_limit, 'myerror' => $myerror]);
        }



         foreach($allCart as $cart)
         {
             $order= new Order;
             $order->product_id=$cart['product_id'];
             $order->user_id=$cart['user_id'];
             $order->status="pending";
             $order->payment_method=$req->payment;
             $order->payment_status="pending";
             $order->address=$req->address;
             $order->save();
             Cart::where('user_id',$userId)->delete(); 
         }
         $req->input();

         //reduce the amount limit in wallet 
         
         $new_limit = (float) $wallet_limit - floatval($total) - 10;
         $wallet->wallet_limit = $new_limit;
         $wallet->save();
         return redirect('/');
    }
    function myOrders()
    {
        if (isset(Session::get('user')['id']) && !empty(Session::get('user')['id'])) {
            $userId=Session::get('user')['id'];
        }else{
            return redirect('/');
        }
        $orders= DB::table('orders')
         ->join('products','orders.product_id','=','products.id')
         ->where('orders.user_id',$userId)
         ->get();
 
         return view('myorders',['orders'=>$orders]);
    }
}
