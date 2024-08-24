<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;

class CartController extends Controller
{
    function addtocart(Request $request, $product_id){
        echo Product::find($product_id)->product_quantity;
        if( $request->quantity>Product::find($product_id)->product_quantity){
            return back()->with('error','Stock are not available');
        }
        
        if(Cart::where('product_id',$product_id)->where('ip_address',request()->ip())->exists()){
            Cart::where('product_id',$product_id)->where('ip_address',request()->ip())->increment('quantity',$request->quantity);
        }
        else{
            Cart::insert([
            'product_id' => $product_id,
            'quantity' => $request->quantity,
            'ip_address' => request()->ip(),
            'created_at' => Carbon::now()

        ]);
        }
        return back();
    }
    function cartdelete ($cart_id){
        Cart::find($cart_id)->delete();
        return back();
    }
}
