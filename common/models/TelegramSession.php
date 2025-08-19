<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "telegram_session".
 *
 * @property int $id
 * @property int $chat_id
 * @property int $step
 * @property string|null $phone
 * @property int $phone_verified
 * @property string|null $verification_token
 * @property int $updated_at
 */
class TelegramSession extends ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'telegram_session';
    }

    const STEP_START = 0;
    const STEP_PHONE = 1;
    const STEP_VERIFICATION = 2;
    const STEP_MENU = 3;

    const STATUS_VERIFIED = 1;
    const STATUS_NOT_VERIFIED = 0;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'verification_token'], 'default', 'value' => null],
            [['phone_verified'], 'default', 'value' => 0],
            [['updated_at'], 'default', 'value' => time()],
            [['chat_id'], 'required'],
            [['chat_id', 'step', 'phone_verified', 'updated_at'], 'integer'],
            [['phone'], 'string', 'max' => 50],
            [['verification_token'], 'string', 'max' => 255],
            [['chat_id'], 'unique'],
            [['verification_token'], 'unique'],
        ];
    }

    public function beforeValidate(): bool
    {
        $this->updated_at = time();
        return parent::beforeValidate();
    }

    public static function getSession(int $chatId): self
    {
        $session = self::findOne(['chat_id' => $chatId]);
        if ($session === null) {
            $session = new self();
            $session->chat_id = $chatId;
            $session->save();
        }
        return $session;
    }

    public function setStep(int $step): void
    {
        $this->step = $step;
        $this->save();
    }

    public function setPhone(string $phone): void
    {
        if ($this->phone != $phone){
            $this->phone_verified = self::STATUS_NOT_VERIFIED;
            $this->phone = $phone;
            $this->verification_token = null;
            $this->step = self::STEP_VERIFICATION;
        }else{
            $this->phone = $phone;
            $this->step = self::STEP_MENU;
        }

        $this->save();
    }

    public function reset()
    {
        $this->step = self::STEP_START;
        $this->phone = null;
        $this->verification_token = null;
        $this->save();
    }

    public function isVerified(): bool
    {
        return (bool) $this->phone_verified;
    }

    public function sendVerificationCode(){
        $verification_code = rand(100000, 999999);
        $this->verification_token = Yii::$app->security->generatePasswordHash($verification_code);
        $this->save();
        $text = 'Sugo bot uchun tasdiqlash kodingiz: ' . $verification_code . '. Ushbu kodni hech kimga bermang!';
        Yii::$app->sms->sendSms($this->phone, $text);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'chat_id' => Yii::t('app', 'Chat ID'),
            'step' => Yii::t('app', 'Step'),
            'phone' => Yii::t('app', 'Phone'),
            'phone_verified' => Yii::t('app', 'Phone Verified'),
            'verification_token' => Yii::t('app', 'Verification Token'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

}
