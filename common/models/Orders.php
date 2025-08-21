<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
 * @property Regions $district
 * @property User $operator
 * @property OrderItems[] $orderItems
 * @property Regions $region
 * @property User $user
 */
class Orders extends ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'orders';
    }

    const STATUS_NEW = 0;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['operator_id', 'full_name', 'address', 'additional_information', 'approved_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 0],
            [['updated_at'], 'default', 'value' => time()],
            [['user_id', 'phone', 'total_price'], 'required'],
            [['user_id', 'operator_id', 'region_id', 'district_id', 'total_price', 'status', 'created_at', 'updated_at', 'approved_at'], 'integer'],
            [['full_name', 'address', 'additional_information'], 'string', 'max' => 200],
            [['phone'], 'string', 'max' => 20],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::class, 'targetAttribute' => ['district_id' => 'id']],
            [['operator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['operator_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::class, 'targetAttribute' => ['region_id' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'Order ID'),
            'user_id' => Yii::t('app', 'Customer ID'),
            'operator_id' => Yii::t('app', 'Operator'),
            'full_name' => Yii::t('app', 'Customer name'),
            'phone' => Yii::t('app', 'Customer phone'),
            'region_id' => Yii::t('app', 'Region'),
            'district_id' => Yii::t('app', 'District'),
            'address' => Yii::t('app', 'Address'),
            'additional_information' => Yii::t('app', 'Additional information'),
            'total_price' => Yii::t('app', 'Total price'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created at'),
            'updated_at' => Yii::t('app', 'Updated at'),
            'approved_at' => Yii::t('app', 'Approved at'),
        ];
    }

    /**
     * Gets query for [[District]].
     *
     * @return ActiveQuery
     */
    public function getDistrict(): ActiveQuery
    {
        return $this->hasOne(Regions::class, ['id' => 'district_id']);
    }

    /**
     * Gets query for [[Operator]].
     *
     * @return ActiveQuery
     */
    public function getOperator(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'operator_id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return ActiveQuery
     */
    public function getOrderItems(): ActiveQuery
    {
        return $this->hasMany(OrderItems::class, ['order_id' => 'id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return ActiveQuery
     */
    public function getRegion(): ActiveQuery
    {
        return $this->hasOne(Regions::class, ['id' => 'region_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
