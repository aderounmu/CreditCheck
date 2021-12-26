<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
class UserController extends Controller
{
    //
    function login(Request $req)
    {
        $myerror = [
            'isError' => false,
            'Message' => ''
        ];
        $user= User::where(['email'=>$req->email])->first();
        if(!$user || !Hash::check($req->password,$user->password))
        {
            $myerror['isError'] = true;
            $myerror['Message'] = "Username or password is not matched";
            return view('login',['myerror' => $myerror]);
        }
        else{
            $req->session()->put('user',$user);
            if($user->isAdmin === '1'){
                return redirect('/admin');
            }
            return redirect('/');
        }
    }

    //register 

    function register(Request $req){
        $this->validate($req,[
            'name'=> 'required',
            'email' => 'required',
            'password' => 'required',
            'v_password' => 'required'
        ]);
        $myerror = [
            'isError' => false,
            'Message' => ''
        ];
        
        $user= User::where(['email'=>$req->email])->first();
        if($user){
            $myerror['isError'] = true;
            $myerror['Message'] = "Sorry User exist";
            return view('register',['myerror' => $myerror]);
            
        }

        if($req->password !== $req->v_password){
            $myerror['isError'] = true;
            $myerror['Message'] = "sorry passwords should be the same";
            return view('register',['myerror' => $myerror]);
        }
        $user = User::create([
            'name'=> $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);

        if($user){
            //creates a new wallet for every new user
            $wallet = $user->wallet ?: new Wallet;
            $wallet->amount_available = 100.0;
            $wallet->wallet_limit = 100.0;
            $user->wallet()->save($wallet);
        }

        $req->session()->put('user',$user);
        return redirect('/');
    }
}
