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

        $session = TelegramSession::getSession($chatId);
        $session->setStep(TelegramSession::STEP_MENU);
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
