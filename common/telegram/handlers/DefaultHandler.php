<?php
namespace common\telegram\handlers;

use Yii;

class DefaultHandler
{
    public function handle($chatId, $text)
    {
        Yii::$app->telegram->sendMessage($chatId, "Kechirasiz, bu buyruqni tushunmadim ❌");
    }
}
