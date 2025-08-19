<?php
namespace common\telegram\handlers;

use common\models\TelegramSession;
use common\telegram\keyboards\KeyboardFactory;
use common\telegram\text\TextFactory;
use Yii;

class MenuHandler
{
    public function handle($chatId, $message, $info, $session)
    {
        if ($message == '📋 Buyurtma berish'){
            Yii::$app->telegram->sendMessage($chatId, TextFactory::openMenuText(), KeyboardFactory::openMenuInline());
        }

        if ($message == '🛒 Savatcha'){
            Yii::$app->telegram->sendMessage($chatId, TextFactory::emptyCartText(), KeyboardFactory::mainMenu());
        }
    }
}
