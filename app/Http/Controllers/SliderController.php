<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SliderController extends Controller
{
    function slider(){
        $sliders = Slider::all();
        $deleted_sliders = Slider::onlyTrashed()->get();
        return view ('slider.index',compact('sliders','deleted_sliders'));
    }
    function sliderpost (Request $request){
        $manager = new ImageManager(new Driver());
        $random_photo_name = Str::random(10).time().".".$request->slider_photo->getClientOriginalExtension();
        $slider_photo = $manager->read($request->file('slider_photo'));
        $slider_photo->toPng()->save(base_path('public/uploads/slider/'). $random_photo_name);
        Slider::insert([
            'slider_name' => $request->slider_name,
            'slider_discription' => $request->slider_discription,
            'slider_photo' => $random_photo_name,
            'created_at' =>Carbon::now()
        ]);
        return back();
    }
    function sliderdelete ($slider_id){
        Slider::find($slider_id)->delete();
        return back();
    }
    function slideredit ($slider_id){
        $slider_info = Slider::find($slider_id);
        return view('slider.edit',compact('slider_info'));
    }

    function slidereditpost (Request $request, $slider_id){
          if($request->hasFile('slider_new_photo')){
            //delete old photo
            unlink(base_path('public/uploads/slider/').Slider::find($slider_id)->slider_photo);
            //upload new photo
            $manager = new ImageManager(new Driver());
            $random_photo_name = Str::random(10).time().".".$request->slider_new_photo->getClientOriginalExtension();
            $slider_photo = $manager->read($request->file('slider_new_photo'));
            $slider_photo->toPng()->save(base_path('public/uploads/slider/'). $random_photo_name);

            Slider::find($slider_id)->update([
                'slider_name' => $request->slider_name,
                'slider_discription' => $request->slider_discription,
                'slider_photo' => $random_photo_name,
            ]);
           return redirect('slider');
        }
        else{
            echo "nai";
        }
    }
     function slideralldelete(){
      Slider::whereNull('deleted_at')->delete();
      return back();
    }
    function sliderrestore ($slider_id){
        Slider::onlyTrashed()->where('id',$slider_id)->restore();
        return back();
    }
    function sliderforcedelete ($slider_id){
       Slider::onlyTrashed()->where('id',$slider_id)->forcedelete();
       return back();
    }
    function sliderallrestore (){
        Slider::onlyTrashed()->restore();
        return back();
    }
}
