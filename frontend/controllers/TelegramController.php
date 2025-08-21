<?php
namespace frontend\controllers;

use yii\web\Controller;
use Yii;
use common\components\Telegram;

class TelegramController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionWebhook(): string
    {
        $data = json_decode(Yii::$app->request->getRawBody(), true);

        if (!$data) {
            return 'ok';
        }

        if (isset($data['callback_query'])) {
            $callback = $data['callback_query'];
            $chatId   = $callback['from']['id'];
            $text_button = $callback['data'];
            Yii::$app->telegramRouter->handleCallback($chatId, $text_button, $callback);
        }else{
            $response = $data;
            $message_object = $data['message'];
            $message_text   = trim($data['message']['text']);
            $chat_id = $data['message']['chat']['id'];

            Yii::$app->telegramRouter->handle($chat_id, $message_text, $message_object, $response);
        }

        return 'ok';
    }
}
