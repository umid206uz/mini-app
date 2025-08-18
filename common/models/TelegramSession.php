<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "telegram_session".
 *
 * @property int $id
 * @property int $chat_id
 * @property int|null $step
 * @property string|null $phone
 * @property string $updated_at
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
    const STEP_MENU = 2;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone'], 'default', 'value' => null],
            [['step'], 'default', 'value' => 0],
            [['chat_id'], 'required'],
            [['chat_id', 'step'], 'integer'],
            [['updated_at'], 'safe'],
            [['phone'], 'string', 'max' => 50],
            [['chat_id'], 'unique'],
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
            $session->step = self::STEP_START;
            $session->updated_at = time();
            $session->save();
        }
        return $session;
    }

    public function setStep(int $step): void
    {
        $this->step = $step;
        $this->updated_at = time();
        $this->save(false);
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
        $this->updated_at = time();
        $this->save(false);
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
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

}
