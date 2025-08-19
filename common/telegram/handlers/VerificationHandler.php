<?php
namespace common\telegram\handlers;

use common\models\TelegramSession;
use common\telegram\keyboards\KeyboardFactory;
use common\telegram\text\TextFactory;
use Yii;

class VerificationHandler
{
    public function handle($chatId, $data, $message, $session)
    {
        if ($message == 'Raqamni o\'zgartirish'){
            $session->reset();
            $session->setStep(TelegramSession::STEP_PHONE);
            Yii::$app->telegram->sendMessage($chatId, TextFactory::helloAndAskPhoneText(), KeyboardFactory::phoneKeyboard());
            return;
        }

        if ($message == 'Kodni qaytadan jo\'natish'){
            $session->sendVerificationCode();
            Yii::$app->telegram->sendMessage($chatId, TextFactory::askCodeText(), KeyboardFactory::verification());
            return;
        }

        if (!$session->validateCode($message)){
            Yii::$app->telegram->sendMessage($chatId, TextFactory::invalidVerificationCodeText(), KeyboardFactory::verification());
            return;
        }else{
            $session->setStep(TelegramSession::STEP_MENU);
            $session->setVerification(TelegramSession::STATUS_VERIFIED);
        }

        Yii::$app->telegram->sendMessage($chatId, TextFactory::phoneNumberText($session->phone));
        Yii::$app->telegram->sendMessage($chatId, "Endi asosiy menyu:", KeyboardFactory::mainMenu());
    }
}
