<?php
namespace common\components;

use common\models\TelegramSession;
use common\telegram\handlers\DefaultHandler;
use common\telegram\handlers\HelpHandler;
use common\telegram\handlers\MenuHandler;
use common\telegram\handlers\OrderCallbackHandler;
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
        'menu'   => MenuHandler::class,
        'checkout'   => OrderCallbackHandler::class,
    ];

    public function handle($chat_id, $message_text, $message_object, $response)
    {
        $session = (new TelegramSession())->getSession($chat_id);

        if ($message_text === '/start') {
            $session->reset();
            (new $this->handlers['/start'])->handle($chat_id, $session, $message_object, $response);
            return;
        }

        switch ($session->step) {

            case TelegramSession::STEP_PHONE:
                (new $this->handlers['phone'])->handle($chat_id, $message_object, $session);
                break;

            case TelegramSession::STEP_VERIFICATION:
                (new $this->handlers['verification'])->handle($chat_id, $message_text, $session);
                break;

            case TelegramSession::STEP_MENU:
                (new $this->handlers['menu'])->handle($chat_id, $message_text, $message_object, $session);
                break;

            case TelegramSession::STEP_CHECKOUT:
                (new $this->handlers['checkout'])->handle($chat_id, $message_text, $message_object, $session);
                break;

            default:
                (new DefaultHandler())->handle($chat_id, $message_object);
        }
    }

    public function handleCallback($chat_id, $text_button, $callback)
    {
        $session = (new TelegramSession())->getSession($chat_id);

        (new $this->handlers['checkout'])->handle($chat_id, $text_button, $callback, $session);
    }

}
