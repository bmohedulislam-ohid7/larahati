<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;
use Auth;

class BlogController extends Controller
{
    function blog (){
        $bloginfos = Blog::all();
        $deleted_blogs = Blog::onlyTrashed()->get();
        return view('blog.index',compact('bloginfos','deleted_blogs'));
    }
    function blogpost (Request $request){
         $manager = new ImageManager(new Driver());
        $random_photo_name = Str::random(10).time().".".$request->blog_photo->getClientOriginalExtension();
        $blog_photo = $manager->read($request->file('blog_photo'));
        $blog_photo->toPng()->save(base_path('public/uploads/blog/'). $random_photo_name);

        Blog::insert([
            'user_id' => Auth::id(),
            'blog_photo' =>  $random_photo_name,
            'blog_title' => $request->blog_title,
            'blog_discription' => $request->blog_discription,
            'created_at' => Carbon::now()
        ]);
        return back();
    }
    function blogdelete ($bloginfo_id){
       Blog::find($bloginfo_id)->delete();
       return back();
    }
    function blogedit ($bloginfo_id){
        $blogedits = Blog::find($bloginfo_id);
        return view('blog.edit',compact('blogedits'));
    }
    function blogeditpost (Request $request, $bloginfo_id){
         if($request->hasFile('blog_new_photo')){
            //delete old photo
            unlink(base_path('public/uploads/blog/').Blog::find($bloginfo_id)->blog_photo);
            //upload new photo
            $manager = new ImageManager(new Driver());
            $random_photo_name = Str::random(10).time().".".$request->blog_new_photo->getClientOriginalExtension();
            $blog_photo = $manager->read($request->file('blog_new_photo'));
            $blog_photo->toPng()->save(base_path('public/uploads/blog/'). $random_photo_name);

            Blog::find($bloginfo_id)->update([
                'blog_photo'=> $random_photo_name,
                'blog_title' => $request->blog_title,
                'blog_discription' => $request->blog_discription,
            ]);
            return redirect('blog');
        }
        else{
            echo "nai";
        }
    }
    function blogrestore ($bloginfo_id){
        Blog::onlyTrashed()->where('id',$bloginfo_id)->restore();
        return back();
    }
    function blogforcedelete ($bloginfo_id){
        Blog::onlyTrashed()->where('id',$bloginfo_id)->forcedelete();
        return back();
    }
    function blogallrestore (){
        Blog::onlyTrashed()->restore();
        return back();
    }
     function blogalldelete(){
      Blog::whereNull('deleted_at')->delete();
      return back();
}
}
