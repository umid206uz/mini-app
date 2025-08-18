<?php
namespace common\components;

use common\telegram\handlers\DefaultHandler;
use common\telegram\handlers\HelpHandler;
use common\telegram\handlers\StartHandler;
use Yii;

class TelegramRouter
{
    protected array $commands = [
        '/start' => StartHandler::class,
        'help'   => HelpHandler::class,
    ];

    public function handle($chatId, $text)
    {
        $command = strtolower($text);

        if (isset($this->commands[$command])) {
            $handlerClass = $this->commands[$command];
            (new $handlerClass())->handle($chatId, $text);
        } else {
            (new DefaultHandler())->handle($chatId, $text);
        }
    }
}
