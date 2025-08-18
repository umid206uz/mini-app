<?php
namespace common\telegram\handlers;

use Yii;

class StartHandler
{
    public function handle($chatId, $text)
    {
        Yii::$app->telegram->sendMessage($chatId, "Assalomu alaykum! Men sizning botingizman 🤖");
    }
}
