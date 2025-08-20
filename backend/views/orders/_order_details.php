<?php
use yii\helpers\Html;

/** @var $order common\models\Orders */
/** @var $orderItems common\models\OrderItems[] */
?>

<div class="card mb-3 shadow-sm">
    <div class="card-header bg-primary text-white">
        <strong>Order #<?= Html::encode($order->id) ?></strong>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-md-6"><strong>Customer:</strong> <?= Html::encode($order->full_name) ?></div>
            <div class="col-md-6"><strong>Phone:</strong> <?= Html::encode($order->phone) ?></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6"><strong>Address:</strong> <?= Html::encode($order->address) ?></div>
            <div class="col-md-6"><strong>Status:</strong>
                <span class="badge bg-info"><?= Html::encode($order->status) ?></span>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6"><strong>Total Price:</strong> <?= number_format($order->total_price, 0, '.', ' ') ?></div>
            <div class="col-md-6"><strong>Created At:</strong> <?= Yii::$app->formatter->asDatetime($order->created_at) ?></div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-secondary text-white">
        <strong>Order Items</strong>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped table-bordered mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($orderItems as $index => $item): ?>
                <tr>
                    <td><?= $index+1 ?></td>
                    <td><?= Html::encode($item->product_name) ?></td>
                    <td><?= $item->quantity ?></td>
                    <td><?= number_format($item->price, 0, '.', ' ') ?></td>
                    <td><?= number_format($item->total_price, 0, '.', ' ') ?></td>
                    <td><?= Yii::$app->formatter->asDatetime($item->created_at) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
