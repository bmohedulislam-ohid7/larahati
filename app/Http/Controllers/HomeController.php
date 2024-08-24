<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cartorder;
use App\Models\Order_details;
use App\Models\Review;
use Auth;
use PDF;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $users = User::all();
        $orders = Cartorder::where('user_id',Auth::id())->latest()->get();
        $creditcard = Cartorder::where('payment_option',1)->count();
        $cashondelivery = Cartorder::where('payment_option',2)->count();
        return view('home',[
            'users' => $users,
            'orders' => $orders,
            'creditcard' => $creditcard,
            'cashondelivery' => $cashondelivery,
        ]);
    }
    public function downloadinvoice ($order_id){
        $data = Cartorder::find($order_id);
        $order_details = Order_details::where('order_id',$order_id)->get();
        $pdf = Pdf::loadView('pdf.invoice', compact('data','order_details'));
        return $pdf->stream('invoice.pdf');
    }
    public function givereview($order_id){
        return view('customergivereview',[
            'order_details' => Order_details::where('order_id',$order_id)->get()
        ]);
    }
    public function reviewpost($order_details_id, Request $request){
        Review::insert([
            'product_id'=> Order_details::find($order_details_id)->product_id,
            'user_id'=> Auth::id(),
            'order_details_id'=> $order_details_id,
            'review_text'=> $request->review_text,
            'stars'=> $request->stars,
            'created_at' => Carbon::now()
        ]);
        return back();
    }
}
