<?php

namespace App\Http\Controllers;
//Use App\Settings;
use Illuminate\Http\Request;



class SettingsController extends Controller
{
    public function index(){
        return view('backend.settings',Settings::getsettings());
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
    
     public function setwebhook(Request $request) {
         
             $result = $this->sendTelegramData('setwebhook',[
                       'query'=>['url'=>$request->url.'/'. \Telegram::getAccessToken()]
                 ]);
             
             return redirect()->route('admin.settings.index');
         
     }  
     
     public function sendTelegramData($route='',$params=[],$method='POST') {
         
            $client = new \GuzzleHttp\Client([
                'base_url'=>'https://api.telegram.org/bot'.\Telegram::getAccessToken().'/'
                ]);
            
            $result = $client->request($method,$route,$params); 
            
            return (string) $result->getBody(); 
         
     }
    
    
    
}
