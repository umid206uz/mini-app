<?php

/** @var yii\web\View $this */
/** @var common\models\Product $model */

$this->title = Yii::t('app', 'Create new');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
