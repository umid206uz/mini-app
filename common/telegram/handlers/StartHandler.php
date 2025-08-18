<?php
namespace common\telegram\handlers;

use Yii;

class StartHandler
{
    public function handle($chatId, $text)
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

        Yii::$app->telegram->sendMessage($chatId, $text, $keyboard);
    }
}
