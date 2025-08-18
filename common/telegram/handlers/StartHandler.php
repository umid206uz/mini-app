<?php
namespace common\telegram\handlers;

use common\models\TelegramSession;
use Yii;

class StartHandler
{
    public function handle($chatId, $data, $session)
    {
        $text = "Assalomu alaykum!\nBuyurtma berish uchun telefon raqamingizni ulashing yoki 991234567 formatida kiriting:";

        $keyboard = [
            'keyboard' => [
                [
                    [
                        'text' => '📱 Telefon raqamni yuborish',
                        'request_contact' => true
                    ]
                ]
            ],
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ];

        $session->setStep(TelegramSession::STEP_PHONE);

        Yii::$app->telegram->sendMessage($chatId, $text, $keyboard);
    }
}
