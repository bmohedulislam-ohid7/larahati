<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testmonial;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;

class TestmonialController extends Controller
{
    function testmonial (){
        $testmonials =Testmonial::all();
        $deleted_testmonials = Testmonial::onlyTrashed()->get();
        return view('testmonial.index',compact('testmonials','deleted_testmonials'));
    }
    function testmonialpost (Request $request){
        $manager = new ImageManager(new Driver());
        $random_photo_name = Str::random(10).time().".".$request->testmonial_photo->getClientOriginalExtension();
        $testmonial_photo = $manager->read($request->file('testmonial_photo'));
        $testmonial_photo->toPng()->save(base_path('public/uploads/testmonial/'). $random_photo_name);

       Testmonial::insert([
        "testmonial_title" => $request->testmonial_title,
        "testmonial_short_discription" => $request->testmonial_short_discription,
        "testmonial_name" => $request->testmonial_name,
        "testmonial_designation" => $request->testmonial_designation,
        "testmonial_photo" =>  $random_photo_name,
         'created_at' => Carbon::now()
       ]);
       return back();
    }
     function testmonialdelete ($testmonial_id){
      if(Testmonial::where('id',$testmonial_id)->exists()){
        Testmonial::find($testmonial_id)->delete();
      }
      return back();
    }
    function testmonialedit ($testmonial_id){
       $testmonial_info = Testmonial::find($testmonial_id);
        return view('testmonial.edit',compact('testmonial_info'));
    }
    function testmonialeditpost (Request $request, $testmonial_id){
        if($request->hasFile('testmonial_new_photo')){
         //delete old photo
            unlink(base_path('public/uploads/testmonial/').Testmonial::find($testmonial_id)->testmonial_photo);
            //upload new photo
            $manager = new ImageManager(new Driver());
            $random_photo_name = Str::random(10).time().".".$request->testmonial_new_photo->getClientOriginalExtension();
            $testmonial_photo = $manager->read($request->file('testmonial_new_photo'));
            $testmonial_photo->toPng()->save(base_path('public/uploads/testmonial/'). $random_photo_name);

            Testmonial::find($testmonial_id)->update([
                "testmonial_title" => $request->testmonial_title,
                "testmonial_short_discription" => $request->testmonial_short_discription,
                "testmonial_name" => $request->testmonial_name,
                "testmonial_designation" => $request->testmonial_designation,
                "testmonial_photo" =>  $random_photo_name,
            ]);
            return redirect('testmonial');
        }
        else{
            echo "nai";
        }
    }
    function testmonialrestore ($testmonial_id){
         Testmonial::onlyTrashed()->where('id',$testmonial_id)->restore();
         return back();
    }
    function testmonialforcedelete($testmonial_id){
         Testmonial::onlyTrashed()->where('id',$testmonial_id)->forcedelete();
         return back();
    }
     function testmonialalldelete(){
      Testmonial::whereNull('deleted_at')->delete();
      return back();
    }
    function testmonialallrestore (){
        Testmonial::onlyTrashed()->restore();
        return back();
    }
}
