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
                    [
                        'text' => '📋 Menyu',
                        'web_app' => [
                            'url' => 'https://shop.sugo.uz'
                        ]
                    ],
                    ['text' => '🛒 Savatcha']
                ],
            ],
            'resize_keyboard' => true
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
