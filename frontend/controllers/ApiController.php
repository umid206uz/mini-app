<?php
namespace frontend\controllers;

use common\models\SmsLog;
use common\telegram\helpers\CartHelper;
use common\telegram\text\TextFactory;
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
            Yii::$app->telegram->sendMessage($chatId, TextFactory::emptyCartText(), KeyboardFactory::openMenuInline($chatId));
            return ['ok' => true, 'empty' => true];
        }

        Yii::$app->telegram->sendMessage($chatId, CartHelper::generateCartText($items, "🛒 Sizning buyurtmangiz", true), KeyboardFactory::confirmOrderInline());
        return ['ok' => true];
    }

    public function actionSmsCallback(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $contentType = Yii::$app->request->getContentType();
        $payload = [];
        if (is_string($contentType) && stripos($contentType, 'application/json') !== false) {
            $payload = json_decode(Yii::$app->request->getRawBody(), true) ?: [];
        } else {
            $payload = Yii::$app->request->post();
        }

        $expected = Yii::$app->params['smsCallbackSecret'] ?? null;
        $got = Yii::$app->request->get('secret');
        if ($expected && $got !== $expected) {
            Yii::warning('SMS callback: secret mismatch', __METHOD__);
            return ['ok' => false, 'reason' => 'forbidden'];
        }

        if (empty($payload)) {
            Yii::warning('SMS callback: empty payload', __METHOD__);
            return ['ok' => true];
        }

        $providerId = $payload['message_id']     ?? $payload['id']           ?? null;
        $userSmsId  = $payload['user_sms_id']    ?? $payload['dispatch_id']  ?? null;
        $phone      = $payload['mobile_phone']   ?? $payload['msisdn']       ?? null;
        $statusRaw  = strtolower((string)($payload['status'] ?? $payload['message'] ?? ''));

        $log = null;
        if ($providerId) {
            $log = SmsLog::findOne(['provider_id' => $providerId]);
        }
        if ($log === null) {
            $log = new SmsLog();
            $log->provider_id = $providerId;
            $log->created_at = time();
        }

        $log->user_sms_id = $userSmsId;
        $log->phone       = $phone;
        $log->status      = $this->mapSmsStatus($statusRaw);
        $log->raw         = json_encode($payload, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        $log->updated_at  = time();
        $log->save(false);

        return ['ok' => true];
    }

    private function mapSmsStatus(string $status): int
    {
        switch ($status) {
            case 'delivered':
                return SmsLog::ST_DELIVERED;
            case 'sent':
            case 'accepted':
                return SmsLog::ST_SENT;
            case 'waiting':
            case 'pending':
                return SmsLog::ST_WAITING;
            case 'rejected':
                return SmsLog::ST_REJECTED;
            case 'canceled':
                return SmsLog::ST_CANCELED;
            case 'not_delivered':
            case 'failed':
            default:
                return SmsLog::ST_FAILED;
        }
    }
}
