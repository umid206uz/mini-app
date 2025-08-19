<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\httpclient\Client;

class Sms extends Component
{
    private string $baseUrl = 'notify.eskiz.uz/api/';
    private string $token;

    public function __construct($config = [])
    {
        $this->token = Yii::$app->params['smsToken'] ?? '';
        parent::__construct($config);
    }

    /**
     * SMS yuborish
     * @throws \yii\base\InvalidConfigException
     */
    public function sendSms(string $phone, string $text)
    {
        $this->refreshToken();
        $client = new Client(['baseUrl' => $this->baseUrl]);

        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl('message/sms/send')
            ->setData([
                'mobile_phone' => '998' . $phone,
                'message'      => $text,
                'from'         => '4546',
                'callback_url' => Yii::$app->params['smsCallbackUrl'] ?? null,
            ])
            ->addHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->send();

        $data = $response->isOk ? $response->data : null;

        if ($data && isset($data['message']) && ($data['message'] === 'Expired' || $data['message'] === 'Invalid Authorization header format')) {

            $this->refreshToken();
            return $this->sendSms($phone, $text);
        }

        if (!$response->isOk) {
            Yii::error("SMS yuborishda xatolik: " . $response->content, __METHOD__);
        }

        return $response->data;
    }

    /**
     * Tokenni yangilash
     * @throws \yii\base\InvalidConfigException
     */
    private function refreshToken()
    {
        dd('asd');
        $client = new Client(['baseUrl' => $this->baseUrl]);

        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl('auth/login')
            ->setData([
                'email'    => Yii::$app->params['smsEmail'],
                'password' => Yii::$app->params['smsPassword'],
            ])
            ->send();

        $data = $response->isOk ? $response->data : null;
        dd($response->data);
        if ($data && isset($data['message']) && $data['message'] === 'token_generated') {
            $this->token = $data['data']['token'];
            Yii::$app->params['smsToken'] = $this->token;
            return $this->token;
        }

        Yii::error("Eskiz token yangilashda xatolik: " . $response->content, __METHOD__);
        return null;
    }
}
