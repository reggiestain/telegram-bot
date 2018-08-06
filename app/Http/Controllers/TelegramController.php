<?php

namespace App\Http\Controllers;

use Telegram\Bot\Api;
use App\Models\Botconfig;
use Illuminate\Support\Facades\Auth;


class TelegramController extends Controller {

    protected $telegram;
    protected $chat_id;
    protected $username;
    protected $token;

    public function __construct() {
        $botconfig = Botconfig::where('user_id', Auth::user()->id)->first();
        $this->token = $botconfig->token;
        $this->telegram = new Api($this->token);
    }

    public function getMe() {
        $response = $this->telegram->getMe();
        return $response;
    }

    public function getBTCEquivalent() {
        $botconfig = Botconfig::where('user_id', Auth::user()->id)->first();
        $client = new \GuzzleHttp\Client();

        $request = $client->get('https://api.coindesk.com/v1/bpi/currentprice/' . 
                                 $botconfig->currency . '.json');
        $body = $request->getBody();
        $response = json_decode($body,true);

        return $response['bpi'][$botconfig->currency];
    }

    public function sendMessage() {
        $res   = $this->getBTCEquivalent();
        $rate  = $res['rate'];
        $float = $res['rate_float'];
        $code  = $res['code'];
        $amount = 30 / (float) $rate; 
        $message = '30 USD is '.$amount.' BTC ('.$float.' '.$code.' - 1 BTC)';
        $data = [
            'chat_id' => '668859911',
            'text' => $message,
        ];

        $this->telegram->sendMessage($data);
    }

}
