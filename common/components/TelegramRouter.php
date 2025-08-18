<?php
namespace common\components;

use common\models\TelegramSession;
use common\telegram\handlers\DefaultHandler;
use common\telegram\handlers\HelpHandler;
use common\telegram\handlers\PhoneHandler;
use common\telegram\handlers\StartHandler;
use Yii;

class TelegramRouter
{
    protected $handlers  = [
        '/start' => StartHandler::class,
        'help'   => HelpHandler::class,
        'phone'   => PhoneHandler::class,
    ];

    public function handle($chatId, $message, $info)
    {
        $session = (new TelegramSession())->getSession($chatId);

        if ($message === '/start') {
            $session->reset();

            (new $this->handlers['/start'])->handle($chatId, $message, $session);
            return;
        }

        switch ($session->step) {

            case TelegramSession::STEP_PHONE:
                (new $this->handlers['phone'])->handle($chatId, $info, $session);
                break;

            default:
                (new DefaultHandler())->handle($chatId, $info);
        }
    }
}
