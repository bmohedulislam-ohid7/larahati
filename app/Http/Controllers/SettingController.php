<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    function setting(){
        $settings = Setting::all();
        return view('setting.index',compact('settings'));     
    }

    function settingpost (Request $request){
       foreach ($request->except('_token') as $key => $value) {
         setting::where('setting_name',$key)->update([
            'setting_value' => $value
         ]);
       }
       return back();
    }

}