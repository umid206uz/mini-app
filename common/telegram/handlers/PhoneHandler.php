<?php
namespace common\telegram\handlers;

use common\models\TelegramSession;
use Yii;

class PhoneHandler
{
    public function handle($chatId, $data, $session)
    {
        if (isset($data['contact']['phone_number'])) {
            $phone = $data['contact']['phone_number'];
        } elseif (isset($data['text']) && preg_match('/^\d{9}$/', $data['text'])) {
            $phone = $data['text'];
        } else {
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
            Yii::$app->telegram->sendMessage($chatId, "❌ Iltimos, to‘g‘ri formatda telefon yuboring", $keyboard);
            return;
        }

        $keyboard_menu = [
            'keyboard' => [
                [['text' => '📋 Menyu'], ['text' => '🛒 Savatcha']],
            ],
            'resize_keyboard' => true
        ];

        $session->setPhone($phone);

        if (!$session->isVerified()){
            $session->sendVerificationCode();
            $keyboard_verification = [
                'keyboard' => [
                    [['text' => 'Raqamni o\'zgartirish'], ['text' => 'Kodni qaytadan jo\'natish']],
                ],
                'resize_keyboard' => true
            ];
            Yii::$app->telegram->sendMessage($chatId, "Kiritilgan telefon raqamga jo\'natilgan kodni kiriting:", $keyboard_verification);
            return;
        }

        Yii::$app->telegram->sendMessage($chatId, "✅ Sizning telefon raqamingiz:\n" . $phone);
        Yii::$app->telegram->sendMessage($chatId, "Endi asosiy menyu:", $keyboard_menu);
    }
}
