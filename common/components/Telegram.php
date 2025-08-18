<?php
namespace common\components;

use yii\base\Component;
use Yii;

class Telegram extends Component
{
    public $botToken;

    public function sendMessage($chatId, $text, $keyboard = null)
    {
        $url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";
        $data = [
            'chat_id' => $chatId,
            'text'    => $text,
        ];
        if ($keyboard) {
            $params['reply_markup'] = json_encode($keyboard);
        }
        $this->sendRequest($url, $data);
    }

    protected function sendRequest($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }
}
