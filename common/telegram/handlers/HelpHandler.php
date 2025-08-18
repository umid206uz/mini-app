<?php
namespace common\telegram\handlers;

use Yii;

class HelpHandler
{
    public function handle($chatId, $text)
    {
        $msg = "Buyruqlar:\n/start - Botni ishga tushirish\nhelp - Yordam";
        Yii::$app->telegram->sendMessage($chatId, $msg);
    }
}
