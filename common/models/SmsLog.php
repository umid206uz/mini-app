<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "sms_log".
 *
 * @property int $id
 * @property string|null $provider_id
 * @property string|null $user_sms_id
 * @property string|null $phone
 * @property int $status
 * @property string|null $raw
 * @property int $created_at
 * @property int $updated_at
 */
class SmsLog extends ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'sms_log';
    }

    const ST_WAITING   = 0;
    const ST_SENT      = 1;
    const ST_DELIVERED = 2;
    const ST_FAILED    = 3;
    const ST_REJECTED  = 4;
    const ST_CANCELED  = 5;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provider_id', 'user_sms_id', 'phone', 'raw'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 0],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['raw'], 'string'],
            [['created_at', 'updated_at'], 'required'],
            [['provider_id', 'user_sms_id'], 'string', 'max' => 64],
            [['phone'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'provider_id' => Yii::t('app', 'Provider ID'),
            'user_sms_id' => Yii::t('app', 'User Sms ID'),
            'phone' => Yii::t('app', 'Phone'),
            'status' => Yii::t('app', 'Status'),
            'raw' => Yii::t('app', 'Raw'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

}
