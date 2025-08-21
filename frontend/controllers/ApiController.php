<?php
namespace frontend\controllers;

use CartHelper;
use common\models\TelegramSession;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\filters\Cors;
use common\telegram\keyboards\KeyboardFactory;
use common\models\Cart;

class ApiController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors(): array
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON
                ]
            ],
            'verbFilter' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'checkout' => ['post'],
                ],
            ],
            'corsFilter' => [
                'class' => Cors::class,
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['POST', 'OPTIONS'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age' => 86400,
                ],
            ],
        ];
    }

    public function actionCheckout(): array
    {
        $chatId = Yii::$app->request->post('chat_id');

        if (empty($chatId) || !preg_match('/^\d+$/', (string)$chatId)) {
            Yii::warning("checkout: noto‘g‘ri chat_id", __METHOD__);
            return ['ok' => false, 'error' => 'Invalid chat_id'];
        }

        $items = Cart::find()->where(['user_id' => $chatId, 'status' => Cart::STATUS_ACTIVE])->all();

        if (!$items) {
            Yii::$app->telegram->sendMessage($chatId, "Savatchangiz bo‘sh 😕");
            return ['ok' => true, 'empty' => true];
        }

        Yii::$app->telegram->sendMessage($chatId, CartHelper::generateCartText($items, "🛒 Sizning buyurtmangiz", true), KeyboardFactory::confirmOrderInline());
        return ['ok' => true];
    }
}
