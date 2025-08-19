<?php
namespace common\components;

use common\models\TelegramSession;
use common\telegram\handlers\DefaultHandler;
use common\telegram\handlers\HelpHandler;
use common\telegram\handlers\PhoneHandler;
use common\telegram\handlers\StartHandler;
use common\telegram\handlers\VerificationHandler;

class TelegramRouter
{
    protected $handlers  = [
        '/start' => StartHandler::class,
        'help'   => HelpHandler::class,
        'phone'   => PhoneHandler::class,
        'verification'   => VerificationHandler::class,
    ];

    public function handle($chatId, $message, $info)
    {
        $session = (new TelegramSession())->getSession($chatId);

        if ($message === '/start') {
            $session->reset();
            (new $this->handlers['/start'])->handle($chatId, $session);
            return;
        }

        switch ($session->step) {

            case TelegramSession::STEP_PHONE:
                (new $this->handlers['phone'])->handle($chatId, $info, $session);
                break;

            case TelegramSession::STEP_VERIFICATION:
                (new $this->handlers['verification'])->handle($chatId, $message, $session);
                break;

            default:
                (new DefaultHandler())->handle($chatId, $info);
        }
    }
}
