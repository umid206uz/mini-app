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
            $chatId   = $callback['message']['chat']['id'];
            $dataText = $callback['data'];
            Yii::$app->telegram->sendMessage($chatId, json_encode($data));
            Yii::$app->telegramRouter->handleCallback($chatId, $dataText, $callback);
        }else{
            $chatId = $data['message']['chat']['id'];
            $info = $data['message'];
            $text   = trim($data['message']['text']);

            Yii::$app->telegramRouter->handle($chatId, $text, $info);
        }

        return 'ok';
    }
}
