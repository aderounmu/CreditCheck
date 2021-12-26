<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Wallet;
use App\Models\Card;
use App\Models\User;

use Session;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function listwallets(){
        $data= Wallet::all();

       return view('admin.listwallets',['wallets'=>$data]);
    }
}
