<?php

namespace App\Http\Controllers;

use Telegram\Bot\Api;
use App\Http\Controllers\Admin\PagesController as Admin;

class TelegramController extends Controller {

    protected $telegram;
    protected $chat_id;
    protected $username;
    protected $token;
    protected $config;

    public function __construct() {
        $this->config = new Admin;
        $this->token = $this->config->getconfig()->token;
        $this->telegram = new Api($this->token);
    }

    public function getMe() {
        $response = $this->telegram->getMe();
        return $response;
    }
    
    public function getMessageId() {
        $response = $this->telegram->getUpdates();
        
        foreach ($response as $key => $value) {
            $chat_id = $value['id'];
        }
        
        return $chat_id;
    }

    public function getBTCEquivalent() {
        $client = new \GuzzleHttp\Client;
        try {
         $request = $client->get('https://api.coindesk.com/v1/bpi/currentprice/' . $this->config->getconfig()->currency . '.json');
         $body = (string) $request->getBody();
          $response = json_decode($body, true);

          return $response['bpi']['USD'];
        } catch (GuzzleHttp\Exception\ClientException $e) {

            if ($e->hasResponse()) {
                $exception = (string) $e->getResponse()->getBody();
                $exception = json_decode($exception);
                return new JsonResponse($exception, $e->getCode());
            } else {
                return new JsonResponse($e->getMessage(), 503);
            }
        }
       
    }

    public function sendMessage() {
        $res = $this->getBTCEquivalent();
        $rate = $res['rate'];
        $float = $res['rate_float'];
        $code = $res['code'];
        $amount = round(abs($rate) / 30, 2);
        $message = '30 USD is ' . $amount . ' BTC (' . $float . ' ' . $code . ' - 1 BTC)';
        $data = [
            'chat_id' => $this->getMessageId(),
            'text' => $message,
        ];

        $this->telegram->sendMessage($data);
    }

}
