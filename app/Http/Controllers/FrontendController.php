<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\City;
use App\Models\User;
use App\Models\Country;
use App\Models\Cartorder;
use App\Models\Order_details;
use App\Models\Review;
use App\Models\Testmonial;
use App\Models\Blog;
use Carbon\Carbon;
use Hash;
use Auth;
use DB;

class FrontendController extends Controller
{
    function home(){
        $raw_val = Order_details::select('product_id', DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->get();
        $collection = collect($raw_val);
        $sorted_best_sellers = $collection->sortByDesc('total')->take(4);
        $categories = Category::all();
        $products = Product::all();
        $sliders = Slider::all();
        $testmonials = Testmonial::all();
        return view('index',compact('categories','products','sorted_best_sellers','sliders','testmonials'));
    }
    function about(){
        return view('about');
    }
    function contact(){
        return view('contact');
    }
    function productdetails($product_id){
        $product_category_id = Product::findorfail($product_id)->category_id;
        $product_info = Product::find($product_id);
        $related_products = Product::where('category_id', $product_category_id)->where('id','!=',$product_id)->get();
        $reviews = Review::where('product_id',$product_id)->get();
        if(Review::where('product_id',$product_id)->exists()){
            $overall_review = Review::where('product_id',$product_id)->sum('stars')/Review::where('product_id',$product_id)->count();
        }
        else{
            $overall_review = 0;
        }
        return view('product.details',compact('product_info','related_products','reviews','overall_review'));
    }
    function shop(){
        $all_products = Product::inRandomOrder()->get();
        $categories = Category::all();
        return view('shop',compact('all_products','categories'));
    }
    function categorywiseshop ($category_id){
        $categories = Category::find($category_id);
        $products = Product::where('category_id',$category_id)->get();
        return view('categorywiseshop',compact('products','categories'));
    }
     function cart($coupon_name = ""){
         $coupon_discount = 0;
        if($coupon_name == ""){
            $coupon_discount = 0;
        }
        else{
            if(Coupon::where('coupon_name',$coupon_name)->exists()){
                if( Carbon::now()->format('Y-m-d') > Coupon::where('coupon_name',$coupon_name)->first()->expire_date){
                    return back()->with('coupon_error','expair hoye geche');
                }
                else{
                    if(Coupon::where('coupon_name',$coupon_name)->first()->uses_limit > 0){
                       $coupon_discount = Coupon::where('coupon_name',$coupon_name)->first()->discount_amount;
                    }
                    else{
                         return back()->with('coupon_error','limit ses');
                    }
                }
            }
            else{
                return back()->with('coupon_error','invilit coupon name');

            }
        }
        return view('cart',[
            'carts' => Cart::where('ip_address',request()->ip())->get(),
            'coupon_name' => $coupon_name,
            'coupon_discount' => $coupon_discount
        ]);
    }
    function updatecart (Request $request){
        // print_r($request->all());
        foreach($request->quantity as $cart_id => $quantity) {
            if(Product::find(Cart::find($cart_id)->product_id)->product_quantity >= $quantity){
                Cart::find($cart_id)->update([
                'quantity' => $quantity,
                ]);
            }
        }
        return back();
    }
    function checkout (){
        $countries = Country::select('country_id','country_name')->get();
        return view('checkout',compact('countries'));
    }
    function customerregister (){
        return view('customerregister ');
    }
    function customerregisterpost (Request $request){
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role'=> 2,
            'created_at' => Carbon::now()
        ]);
        return back();
    }
    function customerlogin (){
        return view('customerlogin');
    }
    function customerloginpost (Request $request){
       if(User::where('email', $request->email)->exists()){
           $db_password = User::where('email', $request->email)->first()->password;
           if(Hash::check($request->password, $db_password)){
                if(Auth::attempt($request->except('_token'))){
                    return redirect()->intended('home');
                }
                return view('customerdashbord');
           }
            else{
                 return back()->with('cus_login_error','Your email or password is wrong!');
            }
       }
       else{
        return back()->with('cus_login_error','email not fount');
       }
    }
    function getcitylist(Request $request){
        $str_to_send = "";
        foreach ( City::where('country_id', $request->country_id)->select('id','name')->get() as $city) {
            $str_to_send = $str_to_send."<option value='".$city->id."'>$city->name</option>";
        }
        echo $str_to_send;
    }
function checkoutpost (Request $request){
    if($request->payment_option == 1){
        // return view('onlinepayment');
        //return redirect('online/payment');
        return redirect('pay');
    }
    else{
        $order_id = Cartorder::insertGetId($request->except('_token')+[
            'user_id' => Auth::id(),
            'payment_status' => 1,
            'discount' => session('session_discount'),
            'subtotal' => session('session_subtotal'),
            'total' => session('session_total'),
            'created_at' => Carbon::now()
        ]);
        $carts = Cart::where('ip_address',request()->ip())->select('id','product_id','quantity')->get();
        foreach ($carts as $cart) {
            Order_details::insert([
                'order_id' => $order_id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
            ]);
            Product::find($cart->product_id)->decrement('product_quantity',$cart->quantity);
            Cart::find($cart->id)->delete();
        }
        return redirect('home');
    }
}
function search(){
    //echo $_GET['s'];
    $search_str = "%" . $_GET['s'] . "%";
    $searched_products = Product::where('product_name',"LIKE",$search_str)->get();
    return view('search',compact('searched_products'));
}
function blogpage(){
    $blogs = Blog::all();
    return view('blog.blogPage',compact('blogs'));
}
}
