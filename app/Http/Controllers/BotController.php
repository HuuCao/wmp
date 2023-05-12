<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BotController extends Controller
{
    public function chatBot()
    {
        $bot_api_key  = '5751384612:AAF-yfw4fWeWlJV2M23WOnwjVvXV1JgCojE';
        $bot_username = 'thanhlk2022Bot';
        $homnay = "Hello world";
        $chatID = '-814715937';

        $apiToken = "5751384612:AAF-yfw4fWeWlJV2M23WOnwjVvXV1JgCojE";
        $data = [
            'chat_id' => '-814715937',
            'text' => $homnay
        ];
        $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data));
    }
}
