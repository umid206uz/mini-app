<?php

namespace common\telegram\keyboards;

class KeyboardFactory
{
    public static function phoneKeyboard(): array
    {
        return [
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
    }

    public static function mainMenu(): array
    {
        return [
            'keyboard' => [
                [
                    ['text' => '🛍 Mahsulotlar'],
                    ['text' => '🛒 Savatcha']
                ],
            ],
            'resize_keyboard' => true
        ];
    }

    public static function openMenuInline($user_id): array
    {
        return [
            'inline_keyboard' => [
                [
                    [
                        'text' => "Menyuni ochish",
                        'web_app' => [
                            'url' => "https://shop.sugo.uz?user_id=" . $user_id
                        ]
                    ]
                ]
            ]
        ];
    }

    public static function confirmOrderInline(): array
    {
        return [
            'inline_keyboard' => [
                [
                    ['text' => "✅ Ha",  'callback_data' => 'order_confirm'],
                    ['text' => "❌ Yo‘q", 'callback_data' => 'order_cancel'],
                ]
            ]
        ];
    }

    public static function cartInline(): array
    {
        return [
            'inline_keyboard' => [
                [
                    ['text' => "📝 Buyurtma berish",  'callback_data' => 'order_confirm'],
                    ['text' => "🗑 Savatni tozalash", 'callback_data' => 'order_cancel'],
                ]
            ]
        ];
    }

    public static function verification(): array
    {
        return [
            'keyboard' => [
                [['text' => "Raqamni o'zgartirish"]],
                [['text' => "Kodni qaytadan jo'natish"]],
            ],
            'resize_keyboard' => true
        ];
    }
}
