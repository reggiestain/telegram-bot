<?php

namespace App\Http\Controllers;
//Use App\Settings;
use Illuminate\Http\Request;



class SettingsController extends Controller
{
    public function index(){
        //return view('backend.settins',Settings::getsettings());
    }
    
    public function store(Request $request) {
        
        Settings:where('key','!=',NULL)->delete();
        foreach ($request->except('_token') as $key => $value) {
                 $setting = new Settings;
                 $setting->key = $key;
                 $setting->value = $request->key;
                 $setting->save();
                                 
        }
        
        //return redirect()->route('admin.settings.index');
        
    }
    
    
}
