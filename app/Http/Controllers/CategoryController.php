<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;

class CategoryController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

    function category(){
      $categories = Category::all();
      $deleted_categories = Category::onlyTrashed()->get();
      return view('category.index',compact('categories','deleted_categories'));
    }
    function categorypost(Request $request){
       $request->validate([
        'category_name' => 'required|unique:categories,category_name'
       ]);
        $manager = new ImageManager(new Driver());
        $random_photo_name = Str::random(10).time().".".$request->category_photo->getClientOriginalExtension();
        $category_photo = $manager->read($request->file('category_photo'));
        $category_photo->toPng()->save(base_path('public/uploads/category/'). $random_photo_name);
       category::insert([
        'category_name' => $request->category_name,
        'category_photo' => $random_photo_name,
        'created_at' => Carbon::now()
       ]);
       return back()->with('category_insert_status','category input successfully');
    }
    function categorydelete ($category_id){
      if(Category::where('id',$category_id)->exists()){
        Category::find($category_id)->delete();
        Product::where('category_id',$category_id)->delete();
      }
      return back()->with('category_delete_status','Category delete Successfully');
    }
    function categoryalldelete(){
      //category::truncate();
      Category::whereNull('deleted_at')->delete();
      return back();
    }
    function categoryedit($category_id){
      $category_info = Category::find($category_id);
      return view('category.edit',compact('category_info'));
    }
    function categoryeditpost(Request $request){
      if($request->category_name == Category::find($request->category_id)->category_name){
        return back()->with('category_same_data_error','same dicho keno');
      }
        Category::find($request->category_id)->update([
          'category_name' => $request->category_name
        ]);
        return redirect('category');
    }
    function categoryrestore($category_id){
      Category::onlyTrashed()->where('id',$category_id)->restore();
      Product::onlyTrashed()->where('category_id',$category_id)->restore();
      return back();
    }
    function categoryforcedelete ($category_id){
      Category::onlyTrashed()->where('id',$category_id)->forcedelete();
      return back();
    }
    function categoryallrestore (){
         Category::onlyTrashed()->restore();
      return back();
    }
}
