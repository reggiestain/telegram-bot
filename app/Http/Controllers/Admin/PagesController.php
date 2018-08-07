<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Botconfig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\TelegramController as Bot;

class PagesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function getuser(){
        $user = Auth::user();        
        return $user;
    }
    
    public function getconfig(){
        $botconfig = Botconfig::where('user_id', $this->getuser()->id)->first();
        return $botconfig;
    }
    
    protected function validator(array $data) {
        return Validator::make($data, [
                    'token' => 'required|string|unique:botconfig',
        ]);
    }

    public function getDashboard() {
        $botconfig = Botconfig::where('user_id', $this->getuser()->id)->first();        
        
        if($botconfig){  
           $bot = new Bot($botconfig->token);
           $telebot = json_decode($bot->getMe());
           $bot->sendMessage();
           return view('admin.pages.account',['config' => $botconfig,'bot'=>$telebot]);
        }
        
        return view('admin.pages.dashboard');
    }
    
    protected function create(array $data) {
        $config = Botconfig::create([
                    'token' => $data['token'],
                    'user_id' => $this->user()->id,
                    'currency' => $data['currency'],
                    'webhook' => $data['webhook'],
        ]);
        
        return $config;
    }

    public function storeconfig(Request $request) {
        
        $validator = $this->validator($request->all());
        
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        // create config
        $this->create($request->all());
        
        return Redirect::back()->with('success', 'Config was created successfully.');
       
    }
    
    public function updateconfig(Request $request) {
        
        $validator = $this->validator($request->all());
        
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        // create config
        $user->name = request('token');
        $user->save();
        return Redirect::back()->with('success', 'Config was updated successfully.');
       
    }

}
