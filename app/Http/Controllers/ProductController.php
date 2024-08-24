<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Featured_photo;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function product(){
        $categories = Category::all();
        $products = Product::where('user_id',Auth::id())->get();
        $deleted_products = Product::onlyTrashed()->get();
      return view('product.index',compact('categories','products','deleted_products'));
    }

    function productpost (Request  $request){
        $manager = new ImageManager(new Driver());
        $random_photo_name = Str::random(10).time().".".$request->product_photo->getClientOriginalExtension();
        $product_photo = $manager->read($request->file('product_photo'));
        $product_photo->toPng()->save(base_path('public/uploads/product/'). $random_photo_name);

        $product_id = Product::insertGetId($request->except('_token','product_photo','product_featured_photos')+[
        'user_id' => Auth::id(),
        'product_photo' => $random_photo_name,
        'created_at' => Carbon::now()
    ]);

    if($request->hasFile('product_featured_photos')){
            foreach ($request->file('product_featured_photos') as $single_featured_photo) {
            $manager = new ImageManager(new Driver());
            $random_photo_name = Str::random(10).time().".".$single_featured_photo->getClientOriginalExtension();
            $product_photo = $manager->read($single_featured_photo);
            $product_photo->toPng()->save(base_path('public/uploads/product_featured/'). $random_photo_name);
            Featured_photo::insert([
                'product_id' => $product_id,
                'featured_photo_name' =>  $random_photo_name,
                'created_at' => Carbon::now()
            ]);
        }
    }

        return back();
    }
    function productedit ($product_id){
        $categories = Category::all();
        $product_info = Product::find($product_id);
        return view('product.edit',compact('product_info','categories'));
    }
    function producteditpost (Request $request, $product_id){
        if($request->hasFile('product_new_photo')){
            //delete old photo
            unlink(base_path('public/uploads/product/').Product::find($product_id)->product_photo);
            //upload new photo
            $manager = new ImageManager(new Driver());
            $random_photo_name = Str::random(10).time().".".$request->product_new_photo->getClientOriginalExtension();
            $product_photo = $manager->read($request->file('product_new_photo'));
            $product_photo->toPng()->save(base_path('public/uploads/product/'). $random_photo_name);

            Product::find($product_id)->update([
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'product_short_discription' => $request->product_short_discription,
                'product_long_discription' => $request->product_long_discription,
                'product_alert_quantity' => $request->product_alert_quantity,
                'product_photo'=> $random_photo_name,
            ]);
            return redirect('product');
        }
        else{
            echo "nai";
        }


    }
    function productdelete ($product_id){
        // if(Product::where('id',$product_id)->exists()){
             Product::find($product_id)->delete();
        // }
        return back();
    }
    function productrestore ($product_id){
       Product::onlyTrashed()->where('id',$product_id)->restore();
       return back();
    }
    function productforcedelete ($product_id){
        Product::onlyTrashed()->where('id',$product_id)->forcedelete();
       return back();
    }
    function productalldelete(){
      Product::whereNull('deleted_at')->delete();
      return back();
    }
    function productallrestore (){
        Product::onlyTrashed()->restore();
        return back();
    }
}
