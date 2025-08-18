<?php
namespace common\telegram\handlers;

use Yii;

class PhoneHandler
{
    public function handle($chatId, $message, $session)
    {
        if (isset($message['contact']['phone_number'])) {
            $phone = $message['contact']['phone_number'];
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

        $session->phone = $phone;
        $session->step = 'menu';
        $session->save(false);
        Yii::$app->telegram->sendMessage($chatId, "✅ Sizning telefon raqamingiz:\n" . $phone);
        Yii::$app->telegram->sendMessage($chatId, "Endi asosiy menyu:", [
            'reply_markup' => json_encode([
                'keyboard' => [
                    [['text' => '📋 Menyu'], ['text' => '🛒 Savatcha']],
                ],
                'resize_keyboard' => true,
            ])
        ]);
    }
}
