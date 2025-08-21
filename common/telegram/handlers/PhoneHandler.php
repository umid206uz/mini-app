<?php
namespace common\telegram\handlers;

use common\telegram\keyboards\KeyboardFactory;
use common\telegram\text\TextFactory;
use Yii;

class PhoneHandler
{
    public function handle($chatId, $data, $session)
    {
        if (isset($data['contact']['phone_number'])) {
            $phone = $data['contact']['phone_number'];
            if (strpos($phone, '998') === 0) {
                $phone = substr($phone, 3);
            }
        } elseif (isset($data['text']) && preg_match('/^\d{9}$/', $data['text'])) {
            $phone = $data['text'];
        } else {
            Yii::$app->telegram->sendMessage($chatId, TextFactory::invalidPhoneNumberText(), KeyboardFactory::phoneKeyboard());
            return;
        }

        $session->setPhone($phone);

        if (!$session->isVerified()){
            $session->sendVerificationCode();
            Yii::$app->telegram->sendMessage($chatId, TextFactory::askCodeText(), KeyboardFactory::verification());
            return;
        }

        Yii::$app->telegram->sendMessage($chatId, TextFactory::phoneNumberText($phone));
        Yii::$app->telegram->sendMessage($chatId, TextFactory::openMenuText(), KeyboardFactory::openMenuInline($chatId));
    }
}
