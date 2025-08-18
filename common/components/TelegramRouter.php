<?php
namespace common\components;

use common\models\TelegramSession;
use common\telegram\handlers\DefaultHandler;
use common\telegram\handlers\HelpHandler;
use common\telegram\handlers\StartHandler;
use Yii;

class TelegramRouter
{
    protected $handlers  = [
        '/start' => StartHandler::class,
        'help'   => HelpHandler::class,
    ];

    public function handle($chatId, $message)
    {
        $session = (new TelegramSession())->getSession($chatId);

        switch ($session->step) {
            case TelegramSession::STEP_START:
                (new $this->handlers['start'])->handle($chatId, $message, $session);
                break;

            case TelegramSession::STEP_PHONE:
                (new $this->handlers['phone'])->handle($chatId, $message, $session);
                break;

            default:
                (new DefaultHandler())->handle($chatId, $message);
        }
    }
}
