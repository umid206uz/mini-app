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

        if (!$data || !isset($data['message'])) {
            return 'ok';
        }

        $chatId = $data['message']['chat']['id'];
        $text   = trim($data['message']['text']);

        Yii::$app->telegramRouter->handle($chatId, $text);

        return 'ok';
    }
}
