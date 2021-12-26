<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Card;
use App\Models\User;
use Session;

class WalletController extends Controller
{
    //
    public function index(){
        $userId=Session::get('user')['id'];
        $wallet = User::find($userId)->wallet;
        $cards = $wallet->cards;
        
        return view('wallet',['cards'=>$cards]);
        // return  $cards;
    }

    public function addCard(){

    }

    public function resetLimit($id){
        $wallet = Wallet::findorfail($id);
        $wallet->wallet_limit = 100.00;
        $wallet->save();
        return redirect('admin/wallets');
        //redirect to
    }

    public function setLimit(Request $req){
        $this->validate($req,[
            'limit' => 'required'
        ]);
        $wallet = Wallet::findorfail($req->wallet_id);
        $wallet->wallet_limit = $req->limit;
        $wallet->save();
        return redirect('admin/wallets');
    }
}
