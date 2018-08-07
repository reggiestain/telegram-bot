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

        if (strlen($this->text) == 24) {
            
            $currency = substr($this->text, -3, 3);            
            $amount = substr($this->text, -6, 2);            
            $message = '/getBTCEquivalent '.$amount.' '. $currency;
            
        } elseif(strlen($this->text) == 20){
            
            $amount = substr($this->text, -3, 3); 
            $currency = 'USD';
            $message = '/getBTCEquivalent '.$amount.' '. $currency;
            
        }else{
            $message = '/getUserID';
        }
        
        switch ($message) {
            case $message:
                $this->sendBTC($this->chat_id, $currency,$amount);
                break;
            case $message:
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

        return $this->handleRequest($requests);
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

    protected function sendBTC($chat_id, $currency, $amount) {
        
        $res = $this->getBTCEquivalent();
        
        $rate = $res['rate'];
        $float = $res['rate_float'];
        $rateamount = round(abs($rate) / 30, 2);
        $message = $amount.' '. $currency . ' is ' . $rateamount . ' BTC (' . $float . ' ' . $currency . ' - 1 BTC)';
        $data = [
            'chat_id' => $chat_id,
            'text' => $message,
        ];

        $this->telegram->sendMessage($data);
    }

}
