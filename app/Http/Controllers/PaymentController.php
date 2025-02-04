<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;

use App\Models\myCart;
use App\Models\myOrder;
use DB;
use Auth;
use Notification;

class PaymentController extends Controller
{
    public function paymentPost(Request $request)
    {       
	Stripe\Stripe::setApiKey('sk_test_51QXBvGKyJnPHGD3gkefWguEIPVh7IC6ZhtV7h3IeKGscO7cMqz6xBlu68TcRy9loHvby27mxnMOBBNuLLffSoQpt00U2vMiYhZ');
        Stripe\Charge::create ([
                "amount" => $request->sub*100,   // RM10  10=10 cen 10*100=1000 cen
                "currency" => "MYR",
                "source" => $request->stripeToken,
                "description" => "This payment is testing purpose of southern online",
        ]);
        
        $newOrder = myOrder::Create([
            'paymentStatus' => "Done",
            'userID' => Auth::id(),
            'amount' => $request->sub,
        ]);
        $orderID=DB::table('my_orders')->where('userID',
        '=', Auth::id())->orderBy('created_at','desc')
        ->first(); // get last record from the user

        $items=$request->input('cid',[]);
        foreach($items as $item=>$value){
            $carts=myCart::find($value);
            $carts->orderID=$orderID->id;
            $carts->save();
        }

        $email = 'seller@live.com';
        Notification::route('mail', $email)->notify(new \App\Notifications\orderPaid($email));

        return back();
    }

}
