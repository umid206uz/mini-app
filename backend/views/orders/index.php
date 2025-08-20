<?php

use common\models\Orders;
use common\order\status\statusText;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\OrdersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs(<<<JS
function loadOrderModal(el) {
    let url = $(el).attr('href');
    $("#orderModalContent").html(
        '<div class="p-5 text-center">' +
        '<div class="spinner-border text-primary" role="status">' +
        '<span class="visually-hidden">Yuklanmoqda...</span>' +
        '</div></div>'
    );
    $.get(url, function(data) {
        $("#orderModalContent").html(data);
    });
}


JS
    ,3)
?>
<div class="orders-index">

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsiveWrap' => false,
        'pager' => [
            'maxButtonCount' => 8,
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'id',
                'label' => 'Actions',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::button('<i class="fa fa-eye"></i>', [
                        'class' => 'btn btn-sm btn-primary view-order',
                        'data-id' => $model->id,
                    ]);
                },
            ],

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
                    return Html::a(
                        statusText::getStatusName($model->status),
                        ['view-details', 'id' => $model->id],
                        [
                            'class' => 'btn btn-sm btn-outline-primary rounded-pill px-3',
                            'data-bs-toggle' => 'modal',
                            'data-bs-target' => '#orderModal',
                            'data-id' => $model->id,
                            'onclick' => 'loadOrderModal(this); return false;',
                        ]
                    );
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
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Orders $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
<?php
use yii\bootstrap5\Modal;

Modal::begin([
    'id' => 'orderModal',
    'title' => '<h5 class="modal-title">Buyurtma ma\'lumotlari</h5>',
    'size' => Modal::SIZE_LARGE,
    'options' => ['class' => 'fade'],
]);
?>
<div id="orderModalContent" class="p-3 text-center">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Yuklanmoqda...</span>
    </div>
</div>
<?php Modal::end(); ?>
