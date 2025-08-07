<?php

/** @var yii\web\View $this */
/** @var common\models\Product $model */

$this->title = Yii::t('app', 'Update Product: {name}', [
    'name' => $model->name_uz,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_uz, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
