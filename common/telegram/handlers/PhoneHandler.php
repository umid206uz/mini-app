<?php
namespace common\telegram\handlers;

use Yii;

class PhoneHandler
{
    public function handle($chatId, $message, $session)
    {
        if (isset($message['contact']['phone_number'])) {
            $phone = $message['contact']['phone_number'];
        } elseif (isset($message['text']) && preg_match('/^\d{9}$/', $message['text'])) {
            $phone = $message['text'];
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

        Yii::$app->telegram->sendMessage($chatId, "✅ Rahmat! Endi asosiy menyu:", [
            'reply_markup' => json_encode([
                'keyboard' => [
                    [['text' => '📋 Menyu'], ['text' => '🛒 Savatcha']],
                ],
                'resize_keyboard' => true,
            ])
        ]);
    }
}
