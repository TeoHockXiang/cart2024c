<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\myCart;
use Auth;

class CartController extends Controller
{
    public function __construct(){
        $this -> middleware('auth');
    }

    public function addCart(){
        $r=request();
        $add=myCart::create([
            'productID' => $r -> id, // product id in database name
            'quantity' => $r -> quantity,
            'userID' => Auth::id(),
            'orderID' => '',
        ]);
        return redirect()->route('myCart');
    }

    public function view(){
        $cart = DB::table('my_carts') // my_carts is table name not folder name
        -> leftjoin('products', 'my_carts.productID', '=', 'products.id')
        -> select('my_carts.quantity as cartQty', 'my_carts.id as cid', 'products.*')
        -> where('my_carts.userID', '=', Auth::id())
        -> orwhere('my_carts.orderID', '=', '')
        -> get();
        //Select my_carts.quantity as cartQty, my_carts.id as cid, products.* from my_carts 
        //left join products on my_carts.productID = products.id where my_carts.userID='$userid'
        //and my_carts.orderID='';
        return view('myCart')->with('products', $cart);
    }
}
