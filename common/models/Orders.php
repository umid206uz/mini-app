<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $operator_id
 * @property string|null $full_name
 * @property string $phone
 * @property int $region_id
 * @property int $district_id
 * @property string|null $address
 * @property string|null $additional_information
 * @property int $total_price
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $approved_at
 *
 * @property OrderItems[] $orderItems
 */
class Orders extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['operator_id', 'full_name', 'address', 'additional_information', 'approved_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 0],
            [['updated_at'], 'default', 'value' => 1754635686],
            [['user_id', 'phone', 'total_price'], 'required'],
            [['user_id', 'operator_id', 'region_id', 'district_id', 'total_price', 'status', 'created_at', 'updated_at', 'approved_at'], 'integer'],
            [['full_name', 'address', 'additional_information'], 'string', 'max' => 200],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'operator_id' => Yii::t('app', 'Operator ID'),
            'full_name' => Yii::t('app', 'Full Name'),
            'phone' => Yii::t('app', 'Phone'),
            'region_id' => Yii::t('app', 'Region ID'),
            'district_id' => Yii::t('app', 'District ID'),
            'address' => Yii::t('app', 'Address'),
            'additional_information' => Yii::t('app', 'Additional Information'),
            'total_price' => Yii::t('app', 'Total Price'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'approved_at' => Yii::t('app', 'Approved At'),
        ];
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::class, ['order_id' => 'id']);
    }

}
