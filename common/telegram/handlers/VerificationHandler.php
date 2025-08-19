<?php
namespace common\telegram\handlers;

use common\telegram\keyboards\KeyboardFactory;
use common\telegram\text\TextFactory;
use Yii;

class VerificationHandler
{
    public function handle($chatId, $data, $message, $session)
    {
        if ($message == 'Raqamni o\'zgartirish'){
            $session->reset();
            Yii::$app->telegram->sendMessage($chatId, TextFactory::helloAndAskPhoneText(), KeyboardFactory::phoneKeyboard());
            return;
        }

        if ($message == 'Kodni qaytadan jo\'natish'){
            $session->sendVerificationCode();
            Yii::$app->telegram->sendMessage($chatId, TextFactory::askCodeText(), KeyboardFactory::verification());
            return;
        }

        if (!$session->validateCode($message)){
            Yii::$app->telegram->sendMessage($chatId, "Kiritilgan kod xato qaytadan urinib ko'ring!", KeyboardFactory::verification());
            return;
        }

        Yii::$app->telegram->sendMessage($chatId, "✅ Sizning telefon raqamingiz:\n" . $session->phone);
        Yii::$app->telegram->sendMessage($chatId, "Endi asosiy menyu:", KeyboardFactory::mainMenu());
    }
}
