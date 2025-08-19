<?php
namespace frontend\controllers;

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

        $items = Cart::find()
            ->alias('c')
            ->joinWith(['product p'])
            ->where(['c.user_id' => $chatId])
            ->all();
        return [
          $items
        ];
        if (!$items) {
            Yii::$app->telegram->sendMessage($chatId, "Savatchangiz bo‘sh 😕");
            return ['ok' => true, 'empty' => true];
        }

        $lines = [];
        $total = 0;
        foreach ($items as $row) {
            /** @var Cart $row */
            $name = $row->product->name ?? 'Mahsulot';
            $qty  = (int)$row->quantity;
            $price = (int)$row->price;
            $sum = $qty * $price;
            $total += $sum;
            $lines[] = "{$name} x{$qty} = {$sum} so‘m";
        }

        $text  = "🛒 Sizning buyurtmangiz:\n\n";
        $text .= implode("\n", $lines);
        $text .= "\n\nJami: <b>{$total} so‘m</b>\n";
        $text .= "Tasdiqlaysizmi?";

        $replyMarkup = KeyboardFactory::confirmOrderInline();

        Yii::$app->telegram->sendMessage($chatId, $text, $replyMarkup, 'HTML');

        return ['ok' => true];
    }
}
