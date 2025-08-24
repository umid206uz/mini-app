<?php

use yii\caching\FileCache;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => FileCache::class,
        ],
        'telegram' => [
            'class' => 'common\components\Telegram',
            'botToken' => '921557934:AAGv1S5XPGoFRGWsrkXI1UPyBNswhs3kcH0',
        ],
        'telegramRouter' => [
            'class' => 'common\components\TelegramRouter',
        ],
        'sms' => [
            'class' => 'common\components\Sms',
        ],
        'formatter' => [
            'class' => 'common\components\FormatterHelper',
        ],
        'status' => [
            'class' => 'common\components\Status',
        ],
    ],
];
