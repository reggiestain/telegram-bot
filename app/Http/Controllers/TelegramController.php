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
    protected $code;

    public function __construct() {
        $this->config = new Admin;
        $this->token = $this->config->getconfig()->token;
        $this->telegram = new Api($this->token);
        $this->code = $this->config->getconfig()->token;
    }

    /**
     * 
     * @param type $requests
     */
    public function handleRequest($requests) {
        foreach ($requests as $request) {
            $this->chat_id = $request['message']['chat']['id'];
            $this->text = $request['message']['text'];
        }

        switch ($this->text) {
            case '/getBTCEquivalent 30 USD';
                $this->sendBTC($this->chat_id);
                break;
            case '/getUserID':
                $this->getUserID($this->chat_id);
                break;
        }
    }
            
    /**
     * 
     * @return type
     */
    public function getMe() {
        $response = $this->telegram->getMe();
        return $response;
    }

    /**
     * 
     * @return type
     */
    public function sendMessage() {
        $requests = $this->telegram->getUpdates();

       return  $this->handleRequest($requests);
    }

    /**
     * 
     * @return \App\Http\Controllers\JsonResponse
     */
    protected function getBTCEquivalent() {

        $client = new \GuzzleHttp\Client;
        try {
            $request = $client->get('https://api.coindesk.com/v1/bpi/currentprice/' . 'USD' . '.json');
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

    /**
     * 
     */
    protected function getUserID($chat_id) {

        $data = [
            'chat_id' => $chat_id,
            'text' => $this->config->getUser()->id,
        ];

        $this->telegram->sendMessage($data);
    }
    
    public function delete() {
      $this->telegram->deleteWebhook();  
    }
    

    protected function sendBTC($chat_id) {
        $res = $this->getBTCEquivalent();
        $rate = $res['rate'];
        $float = $res['rate_float'];
        $code = $res['code'];
        $amount = round(abs($rate) / 30, 2);
        $message = '30 ' . $code . ' is ' . $amount . ' BTC (' . $float . ' ' . $code . ' - 1 BTC)';
        $data = [
            'chat_id' => $chat_id,
            'text' => $message,
        ];

        $this->telegram->sendMessage($data);
    }

}
