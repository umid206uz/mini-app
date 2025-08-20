<?php

use common\order\status\statusText;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Orders $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="orders-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'operator_id',
            'full_name',
            'phone',
            'region_id',
            'district_id',
            'address',
            'additional_information',
            'total_price',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model){
                    return statusText::getStatusName($model->status);
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => 'dateTime'
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'dateTime'
            ],
            [
                'attribute' => 'approved_at',
                'format' => 'dateTime'
            ]
        ],
    ]) ?>

</div>
