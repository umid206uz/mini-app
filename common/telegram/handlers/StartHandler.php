<?php
namespace common\telegram\handlers;

use common\models\TelegramSession;
use common\telegram\keyboards\KeyboardFactory;
use common\telegram\text\TextFactory;
use Yii;

class StartHandler
{
    public function handle($chatId, $data, $session)
    {
        $session->setStep(TelegramSession::STEP_PHONE);

        Yii::$app->telegram->sendMessage($chatId, TextFactory::helloAndAskPhoneText(), KeyboardFactory::phoneKeyboard());
    }
}
