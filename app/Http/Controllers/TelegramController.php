<?php

namespace App\Http\Controllers;

use Telegram\Bot\Api;
Use App\Settings;

class TelegramController extends Controller {

    protected $telegram;

    public function __construct() {
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    public function getMe() {
        $response = $this->telegram->getMe();
        return $response;
    }

}
